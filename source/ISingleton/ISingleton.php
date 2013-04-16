<?php
// Author: Fredrik Åhman
// Course: PHPMVC @ BTH
// File: ISingleton.php
// Desc: Interface for classes using singleton pattern

// @KonradCore!!!
// Uses singleton pattern==Ser till att endast ett objekt instansieras

interface ISingleton{
	public static function Instance();
}

?>