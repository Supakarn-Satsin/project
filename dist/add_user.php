<?php
require "../connect.php";

if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    if ($username == "" || $password == "" || $fullname == "" || $phone == "" || $email == "") {
        echo "<script>
                alert('กรุณากรอกข้อมูลให้ครบถ้วน');
                history.back();
              </script>";
        exit();
    }

    // ตรวจสอบว่ามี username อยู่แล้วหรือไม่
    $check_user = $con->prepare("SELECT * FROM users WHERE username = ?");
    $check_user->bind_param("s", $username);
    $check_user->execute();
    $result = $check_user->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Username นี้มีผู้ใช้งานแล้ว');
                history.back();
              </script>";
        exit();
    }

    // เพิ่มข้อมูล
    $stmt = $con->prepare("INSERT INTO users (username, password, fullname, phone, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $fullname, $phone, $email);

    if ($stmt->execute()) {
        echo "<script>
                alert('บันทึกข้อมูลเรียบร้อยแล้ว');
                window.location.href='index.php?page=user';
              </script>";
    } else {
        echo "<script>
                alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');
                history.back();
              </script>";
    }

    $stmt->close();
    $check_user->close();
}
?>

?>   
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Add user</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Add_users</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row g-4">

              <!--begin::Col-->
              <div class="col-md-12">
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header">
                    <div class="card-title">Add user</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input
                          type="text"
                          class="form-control"
                          id="exampleInputEmail1"
                          aria-describedby="emailHelp"
                        />
                        <div id="emailHelp" class="form-text">
                          Username ต้องไม่ซ้ำกับผู้ใช้อื่น
                        </div>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" />
                      </div>
                        <div class="mb-3">
                            <label for="exampleInputFullname" class="form-label">ชื่อ</label>
                            <input type="text" name="fullname" class="form-control" id="exampleInputFullname" />
                            </div>
                          <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputPassword1" />
                      </div>  
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputPassword1" />
                      </div> 
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-success" name="save'>บันทึกข้อมูล</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>
                <!--end::Quick Example-->
              
              </div>
              <!--end::Col-->

            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->