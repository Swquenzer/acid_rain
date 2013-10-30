<?php

function checkCookie($hash)
{
	if($hash == hash("sha256", "ec457a3974c4d0a885d0a857efa03d137dc8b75d")
	{
		return true;
	}
	
	return false;
}

?>