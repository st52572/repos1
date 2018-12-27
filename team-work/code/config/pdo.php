<?php
function get_pdo($type,$servername,$user,$pass,$database)
    {
        switch ($type)
		{
			case 'mysql':
				$dsn = "{$type}:dbname={$database};host={$servername}";
				break;
			case 'sqlite':
				$dsn = "{$type}:{$servername}";
				break;
		}
                return new PDO(
			$dsn,
			$user,
                        $pass
		);
    }
    