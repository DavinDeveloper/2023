<?
$pl = 'Admin';
$ps = TRUE;
$css .= '
<link href="'.$cf['url'].'assets/vendor/simple-datatables/style.css" rel="stylesheet">';
include '../../library/configuration.php'; 
include '../../library/header.php';
?>
<main id="main" class="main">
    
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Customer</h5>
              <p>Silahkan konfirmasi data customer dibawah.</p>

              <!-- Table with stripped rows -->
              <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">WhatsApp</th>
                    <th scope="col">Identitas</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <? 
                $no = 1;
                if (isset($_POST['suspend'])) {
                    mysqli_query($op, "UPDATE users SET status = 'Suspend' WHERE id = '".$_POST['id']."'");
                    header("Location: ".$cf['url']."admin/customer");
                }
                if (isset($_POST['unsuspend'])) {
                    mysqli_query($op, "UPDATE users SET status = 'Active' WHERE id = '".$_POST['id']."'");
                    header("Location: ".$cf['url']."admin/customer");
                }
                $check_customer = mysqli_query($op, "SELECT * FROM users WHERE level = 'Customer' AND upload = 'Confirmed' AND status != 'Pending'"); 
                while($data_customer = mysqli_fetch_assoc($check_customer)) {?>
                  <tr>
                    <th scope="row"><? echo $no++; ?></th>
                    <td><? echo $data_customer['nama']; ?></td>
                    <td><? echo $data_customer['email']; ?></td>
                    <td><? echo $data_customer['telepon']; ?></td>
                    <td><a href="<? echo $data_customer['identitas']; ?>" target="_blank">Check</a></td>
                    <td><a class="btn btn-warning" href="<? echo $cf['url']; ?>admin/customer/edit?1=<? echo $data_customer['id']; ?>">Edit</a></td>
                    <td>
                    <form method="POST">
                    <input name="id" value="<? echo $data_customer['id']; ?>" hidden>
                    <? if ($data_customer['status'] == 'Active') { ?>
                    <button type="submit" name="suspend" class="btn btn-danger">Suspend</button>
                    <? } else { ?>
                    <button type="submit" name="unsuspend" class="btn btn-success">Unsuspend</button>
                    <? } ?>
                    </form>
                    </td>
                  </tr>
                <? } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
             </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    
</main>

<? 
$js .= '
<script src="'.$cf['url'].'assets/vendor/simple-datatables/simple-datatables.js"></script>';
include '../../library/footer.php'; ?>