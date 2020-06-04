<?php include('server.php') ?>
<?php include('session.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <title> Testing </title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header"> <h2> Edit Data </h2> </div>
       
        <form action="" method="post" >
            
            <table>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" id="name" required="required" value="<?php echo $name?>" readonly="readonly"></td>
                </tr>
                           
                <tr>
                    <td>Birthday</td>
                    <td><input type="date" name="birthday" id="birthday" required="required" value="<?php echo $birthday?>"></td>
                </tr>
                <tr>
                    <td>Education</td>
                    <td><input type="radio" name="education" value="Graduated" id="graduated" <?php if($education=="Graduated"){echo "checked";}?> required="required" >Graduated 
                    <input type="radio" name="education" value="Post Graduated" id="post_graduated" <?php if($education =="Post Graduated"){echo "checked";}?> required="required">Post Graduated</td>
                </tr>
                <tr>
                    <td>IT Skill</td>
                    <td>
                        <?php $checkbox=$skill; $arr=explode(" ",$checkbox); ?>
                        <input type="checkbox" name="skill[]" value="PHP" <?php if(in_array("PHP",$arr)){echo "checked";}?> > PHP 
                        <input type="checkbox" name="skill[]" value="Javascript" <?php if(in_array("Javascript",$arr)){echo "checked";}?>>Javascript
                        <input type="checkbox" name="skill[]" value="CSS" <?php if(in_array("CSS",$arr)){echo "checked";}?>> CSS 
                        <input type="checkbox" name="skill[]" value="MySQL" <?php if(in_array("MySQL",$arr)){echo "checked";}?>>MySQL
                    </td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><input type="radio" name="gender" value="Male" id="male" <?php if( $gender == "Male"){echo "checked";}?> required="required">Male 
                    <input type="radio" name="gender" value="Female" id="female" <?php if($gender == "Female"){echo "checked";}?> required="required">Female</td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td>
                        <select name="department" id="department" class="form-control" required="required" value="<?php echo $department ?>">
                            <option value="" >--- Select Department ---</option>
                            <option value="System Team" <?php if($department =="System Team"){echo "selected";}?>> System Team </option>
                            <option value="Design Team" <?php if($department =="Design Team"){echo "selected";}?> > Design Team </option>
                            <option value="Photoshop Team" <?php if($department =="Photoshop Team"){echo "selected";}?> > Photoshop Team </option>
                            <option value="Autocad Team" <?php if($department =="Autocad Team"){echo "selected";}?> > Autocad Team </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><textarea name="address" cols="30" rows="5"  required="required" > <?php echo $address ?></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" name="update" value="Update" class="btn">Update</button></td>
                    
                </tr>
            </table>
        </form> 
        </div>
    </body>
</html>


