<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="CSS/style2.css" />
    <link rel="icon" href="../project/image/logo.png">
    <title>LEO</title>
    <style>
        
body{

background-color: #0067a6;

}

input[type="date"] {
    color: #14598a;
  }
  select option:nth-child(1) {
    color: #14598a;
  }

  h3{
   color: white;
   font-size: 18px;
   text-align: center;
   padding-top: 20px;
}


.input{

width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 0.5px solid #14598a;
  box-sizing: border-box;
color: white;
  

}
.input1{

width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 0.5px solid #14598a;
  box-sizing: border-box;
  color:#14598a;

  

}


input::placeholder{
    color: #14598a;
    
}
  
        </style>

    <script>
	window.addEventListener('load', function() {
		var inputs = document.querySelectorAll('input, select, textarea');
		var index = 0;
		inputs[index].focus();
		document.addEventListener('keydown', function(e) {
			if (e.keyCode === 37 || e.keyCode === 38) {
				index--;
			} else if (e.keyCode === 39 || e.keyCode === 40) {
				index++;
			}
			if (index < 0) {
				index = inputs.length - 1;
			} else if (index >= inputs.length) {
				index = 0;
			}
			inputs[index].focus();
		});
		document.addEventListener('click', function(e) {
			if (e.target.tagName === 'INPUT' || e.target.tagName === 'SELECT' || e.target.tagName === 'TEXTAREA') {
				index = Array.prototype.indexOf.call(inputs, e.target);
			}
		});
	});
</script>

</head>



<body class="container-fluid">


    <section>
        <div class="row">
            
            <div class="col-3"></div>

            <div class="col-6 ">
                <form method="post" action="<?php echo ($_SERVER["PHP_SELF"]); ?>">
                    
    
                    <fieldset class="fl">


                        <legend>
              <header class="header">
               
               
               <h1>HI THERE ! </h1>
               <h2></h2>
               <h3>Enter the fields below to create your account</h3>

       </header>
                        </legend>


                        <table>
                            <?php
                            ini_set('display_errors', 1);
                            ini_set('display_startup_errors', 1);
                            error_reporting(E_ALL);
                            
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "project";
                            
                            $name = '';
                            $lastname = '';
                            $email = '';
                            $tel = '';
                            $date = '';
                            $gender = '';
                            $country = '';
                            $password = '';
                            $error = '';
                            
                            
                            try {
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            } catch (PDOException $e) {
                                echo "Connection failed: " . $e->getMessage();
                            }
                            
                            function verife(&$name, &$lastname, &$email, &$tel, &$date, &$gender, &$country, &$password, &$error)
                            {
                                if (empty($_POST['name'])) {
                                    $error = "Name is empty !";
                                    return false;
                                } else {
                                    $name = $_POST['name'];
                                }
                            
                                if (empty($_POST['lastname'])) {
                                    $error = "Last name is empty !";
                                    return false;
                                } else {
                                    $lastname = $_POST['lastname'];
                                }
                            
                                if (empty($_POST['email'])) {
                                    $error = "Email is empty !";
                                    return false;
                                } else {
                                    $email = $_POST['email'];
                                }
                            
                                if (empty($_POST['tel'])) {
                                    $error = "Telephone is empty !";
                                    return false;
                                } else {
                                    $tel = $_POST['tel'];
                                }
                            
                                if (empty($_POST['date'])) {
                                    $error = "Date is empty !";
                                    return false;
                                } else {
                                    $date = $_POST['date'];
                                }
                            
                                if (empty($_POST['gender'])) {
                                    $error = "Gender is empty !";
                                    return false;
                                } else {
                                    $gender = $_POST['gender'];
                                }
                            
                                if (empty($_POST['country'])) {
                                    $error = "Country is empty !";
                                    return false;
                                } else {
                                    $country = $_POST['country'];
                                }
                            
                                if (empty($_POST['password'])) {
                                    $error = "Password is empty !";
                                    return false;
                                } else {
                                    $password = $_POST['password'];
                                }
                            
                                if (empty($_POST['confirm_password'])) {
                                    $error = "Confirm Password is empty !";
                                    return false;
                                } else {
                                    $confirm_password = $_POST['confirm_password'];
                                }
                            
                                if ($password != $confirm_password) {
                                    $error = "Passwords do not match !";
                                    return false;
                                }
                            
                                return true;
                            }
                            
                            
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $name = $lastname = $email = $tel = $date = $gender = $country = $password = '';
                                $error = '';

                                if (verife($name, $lastname, $email, $tel, $date, $gender, $country, $password, $error) == false) {

                                    echo '<span style=" font-size: 16px; font-weight: bold;  color: red;">' . $error . '</span>';

                                } else {
                                    $query = "SELECT * FROM inscription WHERE email = :email";
                                    $stmt = $conn->prepare($query);
                                    $stmt->bindValue(':email', $email);
                                    $stmt->execute();
                                    $result = $stmt->fetch(PDO::FETCH_ASSOC);


                                    if ($result) {
                                        $error = "The email already exists";
                                        echo '<span style=" font-size: 16px; font-weight: bold;  color: red;">' . $error . '</span>';
                                    } else {
                                        $sql = "INSERT INTO inscription (name, lastname, email, tel, `date`, gender, country, password)  VALUES ('$name', '$lastname', '$email', '$tel', '$date', '$gender', '$country', '$password')";
                                        if ($conn->query($sql) == TRUE) {
                                             header("Location: success.php");
                
                                        } else {
                                            echo 'Error: ';
                                        }

                                    }
                                }
                                $pdo = null;
                            }
                            ?>

                            <tr>
                                <td>
                                    <label for="noun"> Name: </label>
                                </td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $name; ?>" placeholder="name" class="input" />
                                </td>
                               
                            </tr>
                            <tr>
                                <td>
                                    <label for="noun"> Last name: </label>
                                </td>
                                <td>
                                    <input type="text" name="lastname" value="<?php echo $lastname; ?>"
                                        placeholder="last name" class="input" />
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <label for="mail"> Email: </label>
                                </td>
                                <td>
                                    <input type="text" placeholder="example@domaine.com" class="input" name="email"
                                        value="<?php echo $email; ?>" />
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    <label for="number"> Mobile number: </label>
                                </td>
                                <td>
                                    <input type="tel" placeholder="for exp:+222 00 000 000" class="input" name="tel"
                                        value="<?php echo $tel; ?>" />
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <label for="number">Date of birth: </label>
                                </td>
                                <td>
                                    <input type="date" placeholder="dd/mm/yy" class="input" name="date"
                                        value="<?php echo $date; ?>" />
                                </td>

                            </tr>

                            <tr>
                                <td>
                                    <label>Gender : </label>
                                </td>



                                <td>

                                <select id="gender" class="input1" name="gender" value="<?php echo $gender; ?>">
                                <option disabled selected value="">Select</option>
                                 <option value="M">Male</option>
                                     <option value="F">Female</option>
</select>

                                </td>
                            </tr>
                            <tr>
                                <td>

                                    <label for="code"> Country : </label>
                                </td>
                                <td>
                                    <select id="pays" class="input1" name="country" value="<?php echo $country; ?>">

                                        <option selected="1">
                                            select
                                        </option>

                                        <option value="Afghanistan">Afghanistan </option>
                                        <option value="Afrique_Centrale">Afrique_Centrale </option>
                                        <option value="Afrique_du_sud">Afrique_du_Sud </option>
                                        <option value="Albanie">Albanie </option>
                                        <option value="Algerie">Algerie </option>
                                        <option value="Allemagne">Allemagne </option>
                                        <option value="Andorre">Andorre </option>
                                        <option value="Angola">Angola </option>
                                        <option value="Anguilla">Anguilla </option>
                                        <option value="Arabie_Saoudite">Arabie_Saoudite </option>
                                        <option value="Argentine">Argentine </option>
                                        <option value="Armenie">Armenie </option>
                                        <option value="Australie">Australie </option>
                                        <option value="Autriche">Autriche </option>
                                        <option value="Azerbaidjan">Azerbaidjan </option>

                                        <option value="Bahamas">Bahamas </option>
                                        <option value="Bangladesh">Bangladesh </option>
                                        <option value="Barbade">Barbade </option>
                                        <option value="Bahrein">Bahrein </option>
                                        <option value="Belgique">Belgique </option>
                                        <option value="Belize">Belize </option>
                                        <option value="Benin">Benin </option>
                                        <option value="Bermudes">Bermudes </option>
                                        <option value="Bielorussie">Bielorussie </option>
                                        <option value="Bolivie">Bolivie </option>
                                        <option value="Botswana">Botswana </option>
                                        <option value="Bhoutan">Bhoutan </option>
                                        <option value="Boznie_Herzegovine">Boznie_Herzegovine </option>
                                        <option value="Bresil">Bresil </option>
                                        <option value="Brunei">Brunei </option>
                                        <option value="Bulgarie">Bulgarie </option>
                                        <option value="Burkina_Faso">Burkina_Faso </option>
                                        <option value="Burundi">Burundi </option>
                                        <option value="Caiman">Caiman </option>
                                        <option value="Cambodge">Cambodge </option>
                                        <option value="Cameroun">Cameroun </option>
                                        <option value="Canada">Canada </option>
                                        <option value="Canaries">Canaries </option>
                                        <option value="Cap_vert">Cap_Vert </option>
                                        <option value="Chili">Chili </option>
                                        <option value="Chine">Chine </option>
                                        <option value="Chypre">Chypre </option>
                                        <option value="Colombie">Colombie </option>
                                        <option value="Comores">Colombie </option>
                                        <option value="Congo">Congo </option>
                                        <option value="Congo_democratique">Congo_democratique </option>
                                        <option value="Cook">Cook </option>
                                        <option value="Coree_du_Nord">Coree_du_Nord </option>
                                        <option value="Coree_du_Sud">Coree_du_Sud </option>
                                        <option value="Costa_Rica">Costa_Rica </option>
                                        <option value="Cote_d_Ivoire">Côte_d_Ivoire </option>
                                        <option value="Croatie">Croatie </option>
                                        <option value="Cuba">Cuba </option>
                                        <option value="Danemark">Danemark </option>
                                        <option value="Djibouti">Djibouti </option>
                                        <option value="Dominique">Dominique </option>
                                        <option value="Egypte">Egypte </option>
                                        <option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option>
                                        <option value="Equateur">Equateur </option>
                                        <option value="Erythree">Erythree </option>
                                        <option value="Espagne">Espagne </option>
                                        <option value="Estonie">Estonie </option>
                                        <option value="Etats_Unis">Etats_Unis </option>
                                        <option value="Ethiopie">Ethiopie </option>
                                        <option value="Falkland">Falkland </option>
                                        <option value="Feroe">Feroe </option>
                                        <option value="Fidji">Fidji </option>
                                        <option value="Finlande">Finlande </option>
                                        <option value="France">France </option>
                                        <option value="Gabon">Gabon </option>
                                        <option value="Gambie">Gambie </option>
                                        <option value="Georgie">Georgie </option>
                                        <option value="Ghana">Ghana </option>
                                        <option value="Gibraltar">Gibraltar </option>
                                        <option value="Grece">Grece </option>
                                        <option value="Grenade">Grenade </option>
                                        <option value="Groenland">Groenland </option>
                                        <option value="Guadeloupe">Guadeloupe </option>
                                        <option value="Guam">Guam </option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guernesey">Guernesey </option>
                                        <option value="Guinee">Guinee </option>
                                        <option value="Guinee_Bissau">Guinee_Bissau </option>
                                        <option value="Guinee equatoriale">Guinee_Equatoriale </option>
                                        <option value="Guyana">Guyana </option>
                                        <option value="Guyane_Francaise ">Guyane_Francaise </option>
                                        <option value="Haiti">Haiti </option>
                                        <option value="Hawaii">Hawaii </option>
                                        <option value="Honduras">Honduras </option>
                                        <option value="Hong_Kong">Hong_Kong </option>
                                        <option value="Hongrie">Hongrie </option>

                                        <option value="Inde">Inde </option>
                                        <option value="Indonesie">Indonesie </option>
                                        <option value="Iran">Iran </option>
                                        <option value="Iraq">Iraq </option>
                                        <option value="Irlande">Irlande </option>
                                        <option value="Islande">Islande </option>
                                        <option value="Israel">Israel </option>
                                        <option value="Italie">italie </option>

                                        <option value="Jamaique">Jamaique </option>
                                        <option value="Jan Mayen">Jan Mayen </option>
                                        <option value="Japon">Japon </option>
                                        <option value="Jersey">Jersey </option>
                                        <option value="Jordanie">Jordanie </option>

                                        <option value="Kazakhstan">Kazakhstan </option>
                                        <option value="Kenya">Kenya </option>
                                        <option value="Kirghizstan">Kirghizistan </option>
                                        <option value="Kiribati">Kiribati </option>
                                        <option value="Koweit">Koweit </option>

                                        <option value="Laos">Laos </option>
                                        <option value="Lesotho">Lesotho </option>
                                        <option value="Lettonie">Lettonie </option>
                                        <option value="Liban">Liban </option>
                                        <option value="Liberia">Liberia </option>
                                        <option value="Liechtenstein">Liechtenstein </option>
                                        <option value="Lituanie">Lituanie </option>
                                        <option value="Luxembourg">Luxembourg </option>
                                        <option value="Lybie">Lybie </option>

                                        <option value="Macao">Macao </option>
                                        <option value="Macedoine">Macedoine </option>
                                        <option value="Madagascar">Madagascar </option>
                                        <option value="Madère">Madère </option>
                                        <option value="Malaisie">Malaisie </option>
                                        <option value="Malawi">Malawi </option>
                                        <option value="Maldives">Maldives </option>
                                        <option value="Mali">Mali </option>
                                        <option value="Malte">Malte </option>
                                        <option value="Man">Man </option>
                                        <option value="Mariannes du Nord">Mariannes du Nord </option>
                                        <option value="Maroc">Maroc </option>
                                        <option value="Marshall">Marshall </option>
                                        <option value="Martinique">Martinique </option>
                                        <option value="Maurice">Maurice </option>
                                        <option value="Mauritanie">Mauritanie </option>
                                        <option value="Mayotte">Mayotte </option>
                                        <option value="Mexique">Mexique </option>
                                        <option value="Micronesie">Micronesie </option>
                                        <option value="Midway">Midway </option>
                                        <option value="Moldavie">Moldavie </option>
                                        <option value="Monaco">Monaco </option>
                                        <option value="Mongolie">Mongolie </option>
                                        <option value="Montserrat">Montserrat </option>
                                        <option value="Mozambique">Mozambique </option>

                                        <option value="Namibie">Namibie </option>
                                        <option value="Nauru">Nauru </option>
                                        <option value="Nepal">Nepal </option>
                                        <option value="Nicaragua">Nicaragua </option>
                                        <option value="Niger">Niger </option>
                                        <option value="Nigeria">Nigeria </option>
                                        <option value="Niue">Niue </option>
                                        <option value="Norfolk">Norfolk </option>
                                        <option value="Norvege">Norvege </option>
                                        <option value="Nouvelle_Caledonie">Nouvelle_Caledonie </option>
                                        <option value="Nouvelle_Zelande">Nouvelle_Zelande </option>

                                        <option value="Oman">Oman </option>
                                        <option value="Ouganda">Ouganda </option>
                                        <option value="Ouzbekistan">Ouzbekistan </option>

                                        <option value="Pakistan">Pakistan </option>
                                        <option value="Palau">Palau </option>
                                        <option value="Palestine">Palestine </option>
                                        <option value="Panama">Panama </option>
                                        <option value="Papouasie_Nouvelle_Guinee">Papouasie_Nouvelle_Guinee </option>
                                        <option value="Paraguay">Paraguay </option>
                                        <option value="Pays_Bas">Pays_Bas </option>
                                        <option value="Perou">Perou </option>
                                        <option value="Philippines">Philippines </option>
                                        <option value="Pologne">Pologne </option>
                                        <option value="Polynesie">Polynesie </option>
                                        <option value="Porto_Rico">Porto_Rico </option>
                                        <option value="Portugal">Portugal </option>

                                        <option value="Qatar">Qatar </option>

                                        <option value="Republique_Dominicaine">Republique_Dominicaine </option>
                                        <option value="Republique_Tcheque">Republique_Tcheque </option>
                                        <option value="Reunion">Reunion </option>
                                        <option value="Roumanie">Roumanie </option>
                                        <option value="Royaume_Uni">Royaume_Uni </option>
                                        <option value="Russie">Russie </option>
                                        <option value="Rwanda">Rwanda </option>

                                        <option value="Sahara Occidental">Sahara Occidental </option>
                                        <option value="Sainte_Lucie">Sainte_Lucie </option>
                                        <option value="Saint_Marin">Saint_Marin </option>
                                        <option value="Salomon">Salomon </option>
                                        <option value="Salvador">Salvador </option>
                                        <option value="Samoa_Occidentales">Samoa_Occidentales</option>
                                        <option value="Samoa_Americaine">Samoa_Americaine </option>
                                        <option value="Sao_Tome_et_Principe">Sao_Tome_et_Principe </option>
                                        <option value="Senegal">Senegal </option>
                                        <option value="Seychelles">Seychelles </option>
                                        <option value="Sierra Leone">Sierra Leone </option>
                                        <option value="Singapour">Singapour </option>
                                        <option value="Slovaquie">Slovaquie </option>
                                        <option value="Slovenie">Slovenie</option>
                                        <option value="Somalie">Somalie </option>
                                        <option value="Soudan">Soudan </option>
                                        <option value="Sri_Lanka">Sri_Lanka </option>
                                        <option value="Suede">Suede </option>
                                        <option value="Suisse">Suisse </option>
                                        <option value="Surinam">Surinam </option>
                                        <option value="Swaziland">Swaziland </option>
                                        <option value="Syrie">Syrie </option>

                                        <option value="Tadjikistan">Tadjikistan </option>
                                        <option value="Taiwan">Taiwan </option>
                                        <option value="Tonga">Tonga </option>
                                        <option value="Tanzanie">Tanzanie </option>
                                        <option value="Tchad">Tchad </option>
                                        <option value="Thailande">Thailande </option>
                                        <option value="Tibet">Tibet </option>
                                        <option value="Timor_Oriental">Timor_Oriental </option>
                                        <option value="Togo">Togo </option>
                                        <option value="Trinite_et_Tobago">Trinite_et_Tobago </option>
                                        <option value="Tristan da cunha">Tristan de cuncha </option>
                                        <option value="Tunisie">Tunisie </option>
                                        <option value="Turkmenistan">Turmenistan </option>
                                        <option value="Turquie">Turquie </option>

                                        <option value="Ukraine">Ukraine </option>
                                        <option value="Uruguay">Uruguay </option>

                                        <option value="Vanuatu">Vanuatu </option>
                                        <option value="Vatican">Vatican </option>
                                        <option value="Venezuela">Venezuela </option>
                                        <option value="Vierges_Americaines">Vierges_Americaines </option>
                                        <option value="Vierges_Britanniques">Vierges_Britanniques </option>
                                        <option value="Vietnam">Vietnam </option>

                                        <option value="Wake">Wake </option>
                                        <option value="Wallis et Futuma">Wallis et Futuma </option>

                                        <option value="Yemen">Yemen </option>
                                        <option value="Yougoslavie">Yougoslavie </option>

                                        <option value="Zambie">Zambie </option>
                                        <option value="Zimbabwe">Zimbabwe </option>



                                    </select>

                                </td>


                            </tr>


                            <tr>
                                <td>
                                    <label for="password"> Password : </label>
                                </td>
                                <td>
                                    <input type="password" placeholder="password" class="input" name="password"
                                        value="<?php echo $password; ?>" />
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <label for="password"> Confirm password : </label>
                                </td>
                                <td>
                                    <input type="password" placeholder="confirm password" class="input" name="confirm_password"/>
                                </td>

                            </tr>
                        </table>

                        <button type="submit">Submit</button>
                        <button type="reset" value="Reset">Reset</button>

                        </fieldset>


                </form>

</div>

            </div>


        </div>
    </section>

</body>

</html>