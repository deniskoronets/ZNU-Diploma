<?php

namespace App\Forms;

use App\Models\Department;
use Kris\LaravelFormBuilder\Form;

class User extends Form
{
    public function buildForm()
    {
        $this
            ->add('email', 'text', [
                'rules' => 'required',
                'label' => 'Email',
            ])
            ->add('passw', 'password', [
                'rules' => 'required',
                'label' => 'Пароль',
            ])
            ->add('first_name', 'text', [
                'rules' => 'required',
                'label' => 'Имя',
            ])
            ->add('last_name', 'text', [
                'rules' => 'required',
                'label' => 'Фамилия',
            ])
            ->add('department_id', 'select', [
                'rules' => 'required',
                'label' => 'Кафедра',
                'choices' => Department::lists('name', 'id')->toArray(),
            ])
            ->add('Отправить', 'button', [
                'class' => 'btn btn-success'
            ]);
    }
}
