<?php

namespace Anax\User\HTMLForm;

use Anax\HTMLForm\FormModel;
use Psr\Container\ContainerInterface;
use Anax\User\User;

/**
 * Example of FormModel implementation.
 */
class CreateUserForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Psr\Container\ContainerInterface $di a service container
     */
    public function __construct(ContainerInterface $di)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Create User",
            ],
            [
                "acronym" => [
                    "type"        => "text",
                    "placeholder" => "Username",
                ],

                "password" => [
                    "type"        => "password",
                    "placeholder" => "password",
                ],

                "password-again" => [
                    "type"        => "password",
                    "validation" => [
                        "match" => "password"
                    ],
                ],
                "reset" => [
                    "type"      => "reset",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Create User",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }


    public function callbackSubmit()
    {
        // Get values from the submitted form
        $acronym       = $this->form->value("acronym");
        $password      = $this->form->value("password");
        $passwordAgain = $this->form->value("password-again");

        // Check password matches
        if ($password !== $passwordAgain ) {
            $this->form->rememberValues();
            $this->form->addOutput("Password did not match.");
            return false;
        }

        // Save to database
        // $db = $this->di->get("dbqb");
        // $password = password_hash($password, PASSWORD_DEFAULT);
        // $db->connect()
        // ->insert("User", ["acronym", "password"])
        // ->execute([$acronym, $password]);

        $user = new User();
        $user->setDb($this->di->get("dbqb"));
        $user->acronym = $acronym;
        $user->setPassword($password);
        $user->save();

        $this->form->addOutput("User was created.");
        return true;
    }
}
