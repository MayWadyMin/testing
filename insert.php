<?php include('server.php') ?>
<?php include('session.php')?>
<!DOCTYPE html>
<html>
    <head>
        <title> Testing </title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header"> <h2> Add New Data </h2> </div>
       
        <form action="insert.php" method="post">
            <table>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" class="form-control" id="name" required="required"></td>
                </tr>
                           
                <tr>
                    <td>Birthday</td>
                    <td><input type="date" name="birthday" class="form-control" id="birthday" required="required"></td>
                </tr>
                <tr>
                    <td>Education</td>
                    <td><input type="radio" name="education" value="Graduated" id="graduated" required="required">Graduated 
                    <input type="radio" name="education" value="Post Graduated" id="post_graduated" required="required">Post Graduated</td>
                </tr>
                <tr>
                    <td>IT Skill</td>
                    <td>
                        <input type="checkbox" name="skill[]" value="PHP"> PHP 
                        <input type="checkbox" name="skill[]" value="Javascript">Javascript
                        <input type="checkbox" name="skill[]" value="CSS"> CSS 
                        <input type="checkbox" name="skill[]" value="MySQL">MySQL
                    </td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><input type="radio" name="gender" value="Male" id="male" required="required">Male 
                    <input type="radio" name="gender" value="Female" id="female" required="required">Female</td>
                </tr>
                <tr>
                    <td>Department</td>
                    <td>
                        <select name="department" id="department" class="form-control" required="required">
                            <option value="">--- Select Department ---</option>
                            <option value="System Team"> System Team </option>
                            <option value="Design Team"> Design Team </option>
                            <option value="Photoshop Team"> Photoshop Team </option>
                            <option value="Autocad Team"> Autocad Team </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><textarea name="address" id="address" cols="30" rows="5"  required="required"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" name="add" class="btn">INSERT</button></td>
                    
                </tr>
            </table>
        </form> 
        </div>
    </body>
</html>


