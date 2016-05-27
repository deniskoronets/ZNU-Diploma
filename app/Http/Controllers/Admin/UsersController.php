<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\User as UserForm;
use App\User;
use Hash;

class UsersController extends Controller
{
    public function getList()
    {
        return view('admin.users.list', [
            'users' => User::all(),
        ]);
    }

    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(UserForm::class, [
            'method' => 'POST',
            'url' => route('admin.users.create'),
        ]);

        if (!empty($_POST)) {
            if (!$form->isValid()) {
                return redirect()->back()->withErrors($form->getErrors())->withInput();
            }

            User::create([
                'email' => $form->getData('email'),
                'password' => Hash::make($form->getData('passw')),
                'first_name' => $form->getData('first_name'),
                'last_name' => $form->getData('last_name'),
                'department_id' => $form->getData('department_id'),
            ]);
        }

        return view('admin.users.form', [
            'form' => $form,
        ]);
    }

    public function update($id, FormBuilder $formBuilder)
    {
        $user = User::findOrFail($id);

        $form = $formBuilder->create(UserForm::class, [
            'method' => 'POST',
            'url' => route('admin.users.create'),
        ], $user->toArray());

        if (!empty($_POST)) {
            if (!$form->isValid()) {
                return redirect()->back()->withErrors($form->getErrors())->withInput();
            }

            $data = [
                'email' => $form->getData('email'),
                'first_name' => $form->getData('first_name'),
                'last_name' => $form->getData('last_name'),
                'department_id' => $form->getData('department_id'),
            ];

            if ($form->getData('password')) {
                $data['password'] = $form->getData('passw');
            }

            $user->update($data);
        }

        return view('admin.users.form', [
            'form' => $form,
        ]);
    }
    
}
