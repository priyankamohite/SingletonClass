<?php
/**
 * Created by JetBrains PhpStorm.
 * User: webonise
 * Date: 22/5/13
 * Time: 2:40 PM
 * To change this template use File | Settings | File Templates.
 */


echo strstr("my name is Priyanka", "Priya");
echo "<br/>";

// output : Priyanka

echo strstr("my name is Priyanka", "Priya",1);
echo "<br/>";
//output : my name is

echo strstr("my name is Priyanka Priyanka", "Priya");
echo "<br/>";
//output : Priyanka Priyanka

echo strstr("my name is Priyanka", "priya");
echo "<br/>";
//output : nothing will display as function is case sensitive

echo strstr("my name is Priyanka 1234", 'Priya');
echo "<br/>";
//output : Priyanka 1234

echo strstr("my name is Priyanka 1234", '2');
echo "<br/>";
//output : 234

echo stristr("my name is Priyanka 1234", 'priya');
echo "<br/>";
//output : Priyanka 1234

echo stristr("my name is Priyanka 1234", 'prIyA');
echo "<br/>";
//output : Priyanka 1234

echo substr("my name is Priyanka Mohite",11,5);
echo "<br/>";
//excluding 11th character
//output : Priya

echo substr("my name is Priyanka Mohite",11);
echo "<br/>";
//output : Priyanka Mohite

echo substr("my name is Priyanka Mohite",-6,6);
echo "<br/>";
//output : Mohite

echo strstr("my name is Priyanka Mohite",97);
echo "<br/>";
//output : ame is Priyanka Mohite

echo ord("a");
echo "<br/>";
//output : 97


$token = strtok("my name is Priyanka Mohite. This is assignment on string functions"," ");

while($token!=false){

    echo $token."*";
    $token = strtok(" ");

}
echo "<br/>";
//output : my*name*is*Priyanka*Mohite.*This*is*assignment*on*string*functions*


echo substr_compare("my name is Priyanka Mohite","Priya",11,5);
echo "<br/>";
//output : 0

echo substr_compare("my name is Priyanka Mohite","priya",11,5);
echo "<br/>";
//output : -32


echo substr_compare("my name is Priyanka Mohite","priya",11,5,true);
echo "<br/>";
//output : 0

echo str_replace("Priyanka","Vikaram","my name is Priyanka Mohite");
echo "<br/>";
//output : my name is Vikaram Mohite


$searchThis = array('p', 'm');
$replaceBy   = array('Priyanka', 'Mohite');
$inString    = 'p R. m';
echo str_replace($searchThis, $replaceBy, $inString);
echo "<br/>";
// output :  Priyanka R. Mohite

$searchThis = array('a','b');
$replaceBy   = array('p', 'q');
$inString    = array('abc','ac','b','n');
$output= str_replace($searchThis, $replaceBy, $inString);
print_r($output);
echo "<br/>";
echo "<br/>";
//output : Array ( [0] => pqc [1] => pc [2] => q [3] => n )


//string mathematical operations
$a = "Priyanka";
echo $a+1;
echo "<br/>";
//o/p :1

echo "Priya" +1;
echo "<br/>";
//o/p :1

$b= "Mohite";
echo $a+$b;
echo "<br/>";
//o/p : 0

echo $a.$b;
echo "<br/>";
//o/p : PriyankaMohite

echo "1234"+1;
echo "<br/>";
//o/p : 1235

echo '1234'+1;
echo "<br/>";
//o/p : 1235

echo 1+"1234";
echo "<br/>";
//o/p : 1235



//typecasting

//to boolean
var_dump((bool)"");
//o/p : boolean false

var_dump((bool)"0");
//o/p : boolean false

var_dump((bool)"1");
//o/p : boolean true

//anything other than 0 converted to boolean will give true
var_dump((bool)"589709");
//o/p : boolean true


var_dump((bool) "false");
//o/p : boolean true

var_dump((bool) array(12));
//o/p : boolean true

var_dump((bool) array());
//o/p : boolean false


//to integer
var_dump((int)"true");
//o/p : int 0


var_dump((int)(55/2));
//o/p : int 27

var_dump((float)(55/2));
//o/p : float 27.5

var_dump((float)(55));
//o/p : float 27.5

var_dump((string)55);
//o/p : string '55' (length=2)


var_dump((string)(55/2));
//o/p : string '27.5' (length=4)


