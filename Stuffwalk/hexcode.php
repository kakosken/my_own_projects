<?php
print "hex #FFFFFF is dec " . hexdec("FFFFFF"); // 16777215
print "<br/>";
print "hex #1000 is dec " . hexdec("1000");
print "<br/>";
// $i = hexdec("FFFFFF")/10000;
$i = 256;
// $x = hexdec("FFFFFF");
$x = 4096; //8386;
for($y=0;$y < 16; $y++)
{
	$c = dechex("$y");
	$co = "$c$c$c$c$c$c";
	print "<div style=\"width:100px;height:50px;background-color:$co; border:1px solid;float:left;\">$co</div>";
}
/*
for($y=15;$y > -1; $y--)
{
	$c = dechex("$y");
	$co = "$c$c$c$c$c$c";
	print "<div style=\"width:100px;height:50px;background-color:$co; border:1px solid;float:left;\">$co ($y)</div>";
}

for($y=15;$y > -1; --$y)
{
	$c = dechex("$y");
	$co = "$c$c$c$c$c$c";
	print "<div style=\"width:100px;height:50px;background-color:$co; border:1px solid;float:left;\">$co ($y)</div>";
}
*/
// for($b=15;$b > -1; $b--)
for($b=0;$b < 16; $b++)
{
	for($y=0;$y <16; $y++)
	{
		$c = dechex("$y");
		$b = dechex("$b");
		$co = "$c$b$b$b$b$b";
		print "<div style=\"width:100px;height:50px;background-color:$co; border:1px solid;float:left;\">$co ($y)</div>";
	}
}

for($b=15;$b > -1; --$b)
{
	for($y=15;$y > -1; --$y)
	{
		$c = dechex("$y");
		$b = dechex("$b");
		$co = "$b$c$b$b$b$b";
		print "<div style=\"width:100px;height:50px;background-color:$co; border:1px solid;float:left;\">$co ($y)</div>";
	}
}

for($b=15;$b > -1; --$b)
{
	for($y=15;$y > -1; --$y)
	{
		$c = dechex("$y");
		$b = dechex("$b");
		$co = "$b$b$c$b$b$b";
		print "<div style=\"width:100px;height:50px;background-color:$co; border:1px solid;float:left;\">$co ($y)</div>";
	}
}

for($b=15;$b > -1; --$b)
{
	for($y=15;$y > -1; --$y)
	{
		$c = dechex("$y");
		$b = dechex("$b");
		$co = "$b$b$b$c$b$b";
		print "<div style=\"width:100px;height:50px;background-color:$co; border:1px solid;float:left;\">$co ($y)</div>";
	}
}

for($b=15;$b > -1; --$b)
{
	for($y=15;$y > -1; --$y)
	{
		$c = dechex("$y");
		$b = dechex("$b");
		$co = "$b$b$b$b$c$b";
		print "<div style=\"width:100px;height:50px;background-color:$co; border:1px solid;float:left;\">$co ($y)</div>";
	}
}

for($b=15;$b > -1; --$b)
{
	for($y=15;$y > -1; --$y)
	{
		$c = dechex("$y");
		$b = dechex("$b");
		$co = "$b$b$b$b$b$c";
		print "<div style=\"width:100px;height:50px;background-color:$co; border:1px solid;float:left;\">$co ($y)</div>";
	}
}

for($b=15;$b > -1; --$b)
{
	for($y=15;$y > -1; --$y)
	{
		$c = dechex("$y");
		$b = dechex("$b");
		$co = "$b$b$b$c$c$c";
		print "<div style=\"width:100px;height:50px;background-color:$co; border:1px solid;float:left;\">$co ($y)</div>";
	}
}

for($b=15;$b > -1; --$b)
{
	for($y=15;$y > -1; --$y)
	{
		$c = dechex("$y");
		$b = dechex("$b");
		$co = "$c$c$c$b$b$b";
		print "<div style=\"width:100px;height:50px;background-color:$co; border:1px solid;float:left;\">$co ($y)</div>";
	}
}

for($b=15;$b > -1; --$b)
{
	for($y=15;$y > -1; --$y)
	{
		$c = dechex("$y");
		$b = dechex("$b");
		$co = "$c$b$c$b$c$b";
		print "<div style=\"width:100px;height:50px;background-color:$co; border:1px solid;float:left;\">$co ($y)</div>";
	}
}

for($b=15;$b > -1; --$b)
{
	for($y=15;$y > -1; --$y)
	{
		$c = dechex("$y");
		$b = dechex("$b");
		$co = "$b$c$b$c$b$c";
		print "<div style=\"width:100px;height:50px;background-color:$co; border:1px solid;float:left;\">$co ($y)</div>";
	}
}
/*
for($b=0;$b < 16; $b++)
{
	for($y=0;$y < 16; $y++)
	{
		$c = dechex("$y");
		$b = dechex("$b");
		$co = "$c$b$b$b$c$c";
		print "<div style=\"width:100px;height:50px;background-color:$co; border:1px solid;float:left;\">$co ($y)</div>";
	}
}
/*
for($i; $i < $x;$i++)
{
	$color = "#";
	$color .= dechex($i);
	print "<div style=\"width:100px;height:50px;background-color:$color; border:1px solid;float:left;\">decimal $i is hex $color</div>";
}*/

?>