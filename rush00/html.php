<?php
function e($stuff)
{
	return ("\"".$stuff."\" ");
}

function attr($attr, $value)
{
	if ($value)
		echo $attr."=".e($value);
}

function tag($tag, $classname="", $address="", $alt="", $title="", $rest="")
{
	echo "<".$tag." ";
	if ($tag === "img")
		attr("src", $address);
	else if ($tag === "a")
		attr("href", $address);
	attr("class", $classname);
	attr("alt", $alt);
	attr("title", $title);
	echo $rest;
	if ($tag == "img" || $tag=== "br")
		echo "/>\n";
	else
		echo ">\n";
}

function gat($tag)
{
	echo "</".$tag.">\n";
}
?>
