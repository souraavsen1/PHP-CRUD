<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ToDo App</title>

    <style>
      body{
        background:#FAF5EF;
      }

      .form_conatiner {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        width: 25%;
        margin: 0 auto;
      }

      label {
        padding:10px;
      }

      input{
        margin-left:20px;
      }

      .submit{
        font-size:18px;
        width: 120px;
        height: 30px;
        margin: 0 20%;
        background-color:#79BAEC;
        outline: none;
        color: white;
        cursor:pointer;
      }

      form {
        text-align: left;
        margin-top: 10vh;
      }

      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-bottom:100px;
      }

      td,
      th {
        border: 2px solid #dddddd;
        text-align: left;
        padding:16px;
      }
      tr:nth-child(even) {
        background-color: #ffffff;
      }
      tr:nth-child(odd) {
        background-color: #CFECEC;
      }

      a{
        text-decoration:none;
        color:black;
        cursor:pointer;
        padding: 5px 10px;
        border-radious:20px;
      }

      .delete{
        background:red;
        color:white;
      }

      .edit{
        background:#79BAEC;
        color:white;
      }

      h1{
        text-align:center;
        color:#29465B;
      }

    </style>
  </head>
  <body>
      <?php require_once 'index.php'; ?>
      <?php 
        $conn = mysqli_connect('localhost', 'root', '', 'userdata') or die(mysqli_error($conn));
        $data= "SELECT * from userinfo";
        $result = $conn -> query($data) or die($conn->error);

      ?>
    <form action="index.php" method="POST">
      <h1>User Registraion Form</h1>
      <div class="form_conatiner">
        <input type="hidden" value="<?php echo $id;?>"  name="id" />
        <label for="fname">First Name: <input type="text" value="<?php echo $fname;?>" required name="fname" /></label>
        <label for="lname">Last Name: <input type="text" value="<?php echo $lname;?>" name="lname" /></label>
        <label for="uname">Username: <input type="text" value="<?php echo $uname;?>" required name="uname" /></label>
        <label for="email">E-mail: <input type="text" value="<?php echo $email;?>" required name="email" /></label>
        <label for="pass">Password: <input type="password" value="<?php echo $pass;?>" required name="pass" /></label>
        <label for="dob">Date of Birth: <input type="date" value="<?php echo $dob;?>" required name="dob" /></label>
        <br>
        <?php 
        if($ifupdate == 'ture' ): 
        ?>
          <input type="submit" value="Update" name="update" class="submit" />
        <?php else: ?>
          <input type="submit" value="Save" name="save" class="submit" />
        <?php endif; ?>
      </div>
    </form>

    <br /><br /><br />

    <h1>Total Registered Members</h1>
    <table align="center" style="width: 60%">
      <tr>
        <th>Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>E-mail</th>
        <th>Date of Birth</th>
        <th>Action</th>
        <th>Action</th>
      </tr>

      <?php 
        while ($row = $result->fetch_assoc()):?>
        <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['fname'];?></td>
            <td><?php echo $row['lname'];?></td>
            <td><?php echo $row['uname'];?></td>
            <td><?php echo $row['email'];?></td>
            <td><?php echo $row['dob'];?></td>
            <td>
                <a class="edit" href="home.php?edit=<?php echo $row['id']?>">Edit</a>
            </td>
            <td>
                <a class="delete" href="index.php?delete=<?php echo $row['id']?>">Delete</a>
            </td>
        </tr> 
      <?php endwhile; ?>

    </table>
  </body>
</html>