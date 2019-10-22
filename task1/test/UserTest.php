<?php

    require_once "..\class\User.php";

    use PHPUnit\Framework\TestCase;

    class UserTest extends TestCase
    {
        public function testInsert()
        {
            $user = new User();
            $user->name = "testInput";
            $user->password = "testInput";
            $id = $user->save();
            $userItem = $user->getByID($id);
            $this->assertEquals($user->name, $userItem->name);
            $userItem->delete();
        }

        public function testDelete()
        {
            $user = new User();
            $user->name = "testInput2";
            $user->password = "testInput2";
            $id = $user->save();
            $userItem = $user->getByID($id);
            $userItem->delete();
            $this->assertEquals(null, $user->getByID($id));

        }

        public function testLogin()
        {
            $user = new User();
            $user->name = "test5";
            $user->password = "test5";
            $id = $user->save();
            $user->login("test5", "test5");
            $this->assertEquals("test5", $_SESSION["auth_user"]);
            $userItem = $user->getByID($id);
            $userItem->delete();
        }

        public function testLogout()
        {
            $user = new User();
            $user->name = "test5";
            $user->password = "test5";
            $id = $user->save();
            $user->login("test5", "test5");
            $user->logout();
            $this->assertEquals(null, $_SESSION["auth_user"]);
            $user->delete();
        }
    }