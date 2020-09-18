<?php
	switch ($rid) {
		case 1:
		case 2:
		case 3:
		break;
		default:
			header("Location: ".HOME);
		break;
	}