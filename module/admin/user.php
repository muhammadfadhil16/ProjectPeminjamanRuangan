<?php
  if(!$id_user && $level != "admin"){
    header("location: ".BASE_URL);
  }
?>

<section>
  <div class="container-user">
    <table>
      <caption>Aktivitas User</caption>
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Username</th>
          <th scope="col">Terakhir aktif</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $queryUser = mysqli_query($conn, "SELECT * FROM activity WHERE id_user != '$id_user' ORDER BY last_activity DESC");
          $no = 1;
          while($row = mysqli_fetch_assoc($queryUser)){
            $queryName = mysqli_query($conn, "SELECT * FROM account WHERE id_user='$row[id_user]'");
            $rowName = mysqli_fetch_assoc($queryName);

            echo "<tr>
                    <td data-label='No'>$no</td>
                    <td data-label='Username'>$rowName[username]</td>
                    <td data-label='Terakhir aktif'>$row[last_activity]</td>
                    <td data-label='Action'>
                      <a href='".BASE_URL."index.php?page=module/admin/hapus-user&id_user=$row[id_user]' style='color:red;'>Delete</a>
                    </td>
                  </tr>";
            $no++;
          }
        ?>
      </tbody>
    </table>
  </div>
</section>