<?php



// Array with country names 
$array[] = "Turkish Airlines";
$array[] = "Lufthansa";
$array[] = "KLM Royal Dutch Airlines";
$array[] = "Air France";
$array[] = "British Airways";
$array[] = "Virgin Atlantic";
$array[] = "easyJet";
$array[] = "Ryanair";
$array[] = "SAS Scandinavian Airlines";
$array[] = "Johanna";
$array[] = "Aer Lingus";
$array[] = "El Al";
$array[] = "Arkia";
$array[] = "Qatar Airways";
$array[] = "Singapore Airlines";
$array[] = "Emirates";
$array[] = "Japan Airlines";
$array[] = "Hainan Airlines";
$array[] = "Thai Airways";
$array[] = "Swiss International Air Lines";
$array[] = "United Airlines";
$array[] = "Air New Zealand";
$array[] = "Air Canada";
$array[] = "Etihad Airways";
$array[] = "KLM Royal Dutch Airlines";
$array[] = "Aeroflot";
$array[] = "Sky Airlines";
$array[] = "Israir Airlines";
$array[] = "Aeronautics Defense Systems";
$array[] = "Malaysia Airlines";
$array[] = "Norwegian Air Shuttle";
$array[] = "Ukraine International Airlines";
$array[] = "Wizz Air";
$array[] = "AirAsia";
$array[] = "British Airways";
$array[] = "China Eastern Airlines";
$array[] = "Delta Air Lines";
$array[] = "Emirates";
$array[] = "Finnair";
$array[] = "Garuda Indonesia";
$array[] = "Hawaiian Airlines";
$array[] = "Icelandair";
$array[] = "JetBlue";
$array[] = "KLM Royal Dutch Airlines";
$array[] = "Lufthansa";
$array[] = "Malaysia Airlines";
$array[] = "Norwegian Air Shuttle";
$array[] = "Oman Air";
$array[] = "Philippine Airlines";
$array[] = "Qantas";
$array[] = "Ryanair";
$array[] = "Singapore Airlines";
$array[] = "Turkish Airlines";
$array[] = "United Airlines";
$array[] = "Virgin Atlantic";
$array[] = "Wizz Air";
$array[] = "XiamenAir";
$array[] = "Yamal Airlines";
$array[] = "Zoom Airlines";

// Array with  country name
$array[] = "Albania";
$array[] = "Belgium";
$array[] = "Canada";
$array[] = "Denmark";
$array[] = "Estonia";
$array[] = "Finland";
$array[] = "Germany";
$array[] = "Hungary";
$array[] = "Iceland";
$array[] = "Ireland";
$array[] = "Italy";
$array[] = "Israel";
$array[] = "Japan";
$array[] = "Kenya";
$array[] = "Lithuania";
$array[] = "Malta";
$array[] = "Nepal";
$array[] = "Oman";
$array[] = "Poland";
$array[] = "Qatar";
$array[] = "Russia";
$array[] = "Spain";
$array[] = "Turkey";
$array[] = "Uganda";
$array[] = "Vietnam";
$array[] = "Wales";
$array[] = "Xinjiang";
$array[] = "Yemen";
$array[] = "Zambia";

// Array with IATA

$array[] = "Ay315";
$array[]= "By941";
$array[]= "Cy782";
$array[]= "Dy643";
$array[]= "Ey182";
$array[]= "Fy902";
$array[]= "Gy731";
$array[]= "Hy274";
$array[]= "Iy561";
$array[]= "Jy813";
$array[]= "Ky964";
$array[]= "Ly123";
$array[]= "My452";
$array[]= "Ny746";
$array[]= "Oy819";
$array[]= "Py532";
$array[]= "Qy106";
$array[]= "Ry947";
$array[]= "Sy281";
$array[]= "Ty654";
$array[]= "Uy198";
$array[]= "Vy739";
$array[]= "Wy382";
$array[]= "Xy465";
$array[]= "Yy908";
$array[]= "Zy241";


// get the q parameter from URL
$query = $_REQUEST["q"];

$suggestion = "";

// lookup all company airline / country name / IATA code 
if ($query !== "") {
  $query = strtolower($query);
  $len=strlen($query);
  foreach($array as $name) {
    if (stristr($query, substr($name, 0, $len))) {
      if ($suggestion === "") {
        $suggestion = $name;
      } else {
        $suggestion .= " | $name";
      }
    }
  }
}

// Output "no solution" if no company airline / country name / IATA code  was found 
echo $suggestion === "" ? "Sorry 😢 , there is no solution" : $suggestion;
?>