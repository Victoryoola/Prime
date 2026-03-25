<?php

class PropertyController extends Controller
{
    private PropertyModel $properties;
    private LocationModel $locations;

    public function __construct()
    {
        Auth::requireAgent();
        $db = $this->db();
        $this->properties = new PropertyModel($db);
        $this->locations  = new LocationModel($db);
    }

    public function dashboard(): void
    {
        $properties = $this->properties->getAll();
        $this->view('users/agents/dashboard', [
            'pageTitle'  => 'Dashboard',
            'properties' => $properties,
        ]);
    }

    public function index(): void
    {
        $properties = $this->properties->getByAgent(Auth::agentId());
        $this->view('users/agents/viewProperty', [
            'pageTitle'  => 'View Properties',
            'properties' => $properties,
        ]);
    }

    public function create(): void
    {
        $states = $this->locations->getStates();
        $this->view('users/agents/createProperty', [
            'pageTitle' => 'Create Property',
            'states'    => $states,
        ]);
    }

    public function store(): void
    {
        try {
            $price = $this->parsePrice($_POST['price'] ?? '');
        } catch (Exception $e) {
            $this->redirect(URLROOT . '/Estate/agent/properties/create?error=' . urlencode($e->getMessage()));
        }

        $agentId     = Auth::agentId();
        $title       = $_POST['title'] ?? '';
        $status      = $_POST['propertyStatus'] ?? '';
        $state       = (int) ($_POST['state'] ?? 0);
        $lga         = (int) ($_POST['lga'] ?? 0);
        $address     = $_POST['address'] ?? '';
        $kitchen     = (int) ($_POST['kitchenNumber'] ?? 0);
        $bath        = (int) ($_POST['bathNumber'] ?? 0);
        $bed         = (int) ($_POST['bedNumber'] ?? 0);
        $description = $_POST['propertyDescription'] ?? '';

        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/Estate/public/images/';

        try {
            $propertyId = $this->properties->create($agentId, $title, $price, $status, $state, $lga, $address, $kitchen, $bath, $bed, $description);

            for ($i = 1; $i <= 4; $i++) {
                $key = 'image' . $i;
                if (isset($_FILES[$key]) && $_FILES[$key]['error'] === UPLOAD_ERR_OK) {
                    $imageName = $this->uploadImage($_FILES[$key], $uploadDir);
                    $this->properties->addImage($propertyId, $imageName);
                }
            }

            $this->redirect(URLROOT . '/Estate/agent/properties/create?success=' . urlencode('Property created successfully'));
        } catch (Exception $e) {
            $this->redirect(URLROOT . '/Estate/agent/properties/create?error=' . urlencode($e->getMessage()));
        }
    }

    public function edit(): void
    {
        $id   = (int) ($_GET['id'] ?? 0);
        $data = $this->properties->getForEdit($id);
        $states = $this->locations->getStates();

        $this->view('users/agents/editProperty', [
            'pageTitle'       => 'Edit Property',
            'propertyDetails' => $data['details'],
            'propertyImages'  => $data['images'],
            'states'          => $states,
        ]);
    }

    public function update(): void
    {
        $id = (int) ($_POST['property_id'] ?? 0);

        try {
            $price = $this->parsePrice($_POST['price'] ?? '');
        } catch (Exception $e) {
            $this->redirect(URLROOT . '/Estate/agent/properties/' . $id . '/edit?error=' . urlencode($e->getMessage()));
        }

        $title       = $_POST['title'] ?? '';
        $status      = $_POST['propertyStatus'] ?? '';
        $state       = (int) ($_POST['state'] ?? 0);
        $lga         = (int) ($_POST['lga'] ?? 0);
        $address     = $_POST['address'] ?? '';
        $kitchen     = (int) ($_POST['kitchenNumber'] ?? 0);
        $bath        = (int) ($_POST['bathNumber'] ?? 0);
        $bed         = (int) ($_POST['bedNumber'] ?? 0);
        $description = $_POST['propertyDescription'] ?? '';

        try {
            $this->properties->update($id, $title, $price, $status, $state, $lga, $address, $kitchen, $bath, $bed, $description);
            $this->redirect(URLROOT . '/Estate/agent/properties?status=success&message=' . urlencode('Property updated'));
        } catch (Exception $e) {
            $this->redirect(URLROOT . '/Estate/agent/properties/' . $id . '/edit?error=' . urlencode($e->getMessage()));
        }
    }

    public function delete(): void
    {
        $id = (int) ($_POST['property_id'] ?? 0);
        try {
            $this->properties->delete($id);
            $this->redirect(URLROOT . '/Estate/agent/properties?deleted=success');
        } catch (Exception $e) {
            $this->redirect(URLROOT . '/Estate/agent/properties?error=' . urlencode($e->getMessage()));
        }
    }

    public function single(): void
    {
        $id   = (int) ($_GET['id'] ?? 0);
        $data = $this->properties->getById($id);
        $agentDetails = (new UserModel($this->db()))->findById(Auth::agentId());

        $this->view('users/agents/property-single', [
            'pageTitle'       => $data['details']['propertyTitle'] ?? 'Property',
            'propertyDetails' => $data['details'],
            'propertyImages'  => $data['images'],
            'agentDetails'    => $agentDetails,
        ]);
    }
}
