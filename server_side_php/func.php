<?php
    function db($params = array())
    {
        if (isset($params['hostname'])) {
            $hostname = $params['hostname'];
        } else {
            $hostname = "localhost";
        }

        if (isset($params['username'])) {
            $username = $params['username'];
        } else {
            $username = "root";
        }

        if (isset($params['password'])) {
            $password = $params['password'];
        } else {
            $password = "123";
        }

        if (isset($params['database'])) {
            $database = $params['database'];
        } else {
            $database = "kang_test";
        }

        $conn = new mysqli($hostname, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    function query_get($sql = null)
    {
        $db = db();
        
        if ($sql === null) {
            return null;
        } else {
            if ($result = $db->query($sql)) 
            {
                $data = [];
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return $data;

                $result->free();
            }

            $db->close();
        }
    }

    function query_raw($sql = null)
    {
        $db = db();
        
        if ($sql === null) {
            return null;
        } else {
            if ($result = $db->query($sql)) 
            {
                return $result;

                $result->free();
            }

            $db->close();
        }
    }