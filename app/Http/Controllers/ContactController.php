<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Services\Contact\ContactServiceInterface;


class ContactController extends Controller
{
    private ContactServiceInterface $contactService;

    public function __construct(ContactServiceInterface $contactService)
    {
      
        $this->contactService = $contactService;
    }
    public function store(Request $request): RedirectResponse
    {

        $arrayvalid = [];
        $name = $request->post('name');
        $phone = $request->post('phone');
        $email = $request->post('email');
        $source = 'Account';
        $data=['name'=>$name,'phone'=>$phone,'email'=>$email,'source'=>$source];
        if (empty($name)) {
            array_push($arrayvalid, 'name is required');
        }
        if (empty($phone)) {
            array_push($arrayvalid, 'phone is required');
        }
        if (empty($email)) {
            array_push($arrayvalid, 'email is required');
        }
        

        $statusFlag = true;
        $messages = '';

        if (!empty($arrayvalid)) {
            return redirect()->route('contact.create')
                ->withErrors($arrayvalid);
        }

        if ($statusFlag == false) {
            return redirect()->route('contact.create')
                ->withErrors($messages);
        }


        // Store file information in the database

        $contact = $this->contactService->createContact($data);

        // $uploadedFile = new Contact();
        // $uploadedFile->name = $request->get('name');
        // $uploadedFile->phone = $request->get('phone');
        // $uploadedFile->email = $request->get('email');
        // $uploadedFile->source = 1;
        // $uploadedFile->save();
       // $getId = $uploadedFile->id;
        // Redirect back to the index page with a success message
        return redirect()->route('contact.index')
            ->with('success', "New Contact Added successfully.");
    }

    // shows the create form
    public function create()
    {
        return view('contact.create');
    }

    // shows the uploads index
    public function index()
    {
        $uploadedFiles = Contact::all();

        return view('contact.index', compact('uploadedFiles'));
    }
    public function delete(Request $request)
    {
        Contact::deleteContact($request->id);
        $uploadedFiles = Contact::all();
        return view('contact.index', compact('uploadedFiles'));
    }

    public function showform(Request $request)
    {

        $getAll = Contact::viewFormById($request->id);
        if (empty($getAll)) {
            return redirect()->to('/');
        }

        return view('contact.show', compact('getAll'));
    }

    public function edit(Request $request)
    {

        $getAll = Contact::viewFormById($request->id);
        if (empty($getAll)) {
            return redirect()->to('/');
        }

        return view('contact.edit', compact('getAll'));
    }

    public function update(Request $request): RedirectResponse
    {

        $arrayvalid = [];
        $name = $request->post('name');
        $formId = $request->post('formId');
        $phone = $request->post('phone');
        $email = $request->post('email');
        $source = 1;

        if (empty($name)) {
            array_push($arrayvalid, 'name is required');
        }
        if (empty($phone)) {
            array_push($arrayvalid, 'phone is required');
        }
      
        if (empty($email)) {
            array_push($arrayvalid, 'email is required');
        }
      

        $statusFlag = true;
        $messages = [];

        if (!empty($arrayvalid)) {
            return redirect()->route('contact.edit', ['id' => $formId])->withErrors($arrayvalid);
        }

       
        if ($statusFlag == false) {
            return redirect()->route('contact.edit', ['id' => $formId])->withErrors($messages);
        }


        // Store file information in the database
        $uploadedFile = new Contact();
        $uploadedFile->exists = true;
        $uploadedFile->id = $formId; //already exists in database.
        $uploadedFile->name = $request->get('name');
        $uploadedFile->phone = $request->get('phone');
        $uploadedFile->email = $request->get('email');
        $uploadedFile->save();


        // Redirect back to the index page with a success message
        return redirect()->route('contact.index')
            ->with('success', "Form Updated successfully.");
    }
}
