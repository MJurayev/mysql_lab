<?php
require "./includes/db.inc.php";
require "./actions/pupils.php";
$result = mysqli_query($connection, "select * from pupils_view");
$pupils = [];
while($res =mysqli_fetch_assoc($result)){
    $pupils[] =$res;
}


$result = mysqli_query($connection, "select * from faculty");
$items = [];
while($res =mysqli_fetch_assoc($result)){
    $items[] =$res;
}
?>

<?php include "./components/navbar.php"?>

        <?php
        if($_GET['action'] == 'edit' && isset($_GET['id']) ):
        ?>
        <?php $sql="select * from pupils where id=".$_GET['id'];
            $result = @mysqli_query($connection, $sql);
            if($result) {
                $pupil = mysqli_fetch_assoc($result);

            }else{
                session_start();
                $_SESSION['error']="Bunday o'quvchi yo'q";
            }
        ?>
            <div class="row">
                <div class="col">
                    <h2 class="text-center">O'quvchi o'zgartirish</h2>
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="get" class="form form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="surname">Familiyasi</label>
                                <input type="text" name="surname" id="surname" value="<?=$pupil['surname']?>" class="form-control" required>

                                <label for="address">Manzili</label>
                                <input type="text" name="address" id="address"  value="<?=$pupil['address']?>" class="form-control" required>
                                <input type="hidden" value="edit-data" name="action">
                                <input type="hidden" value="<?=$pupil['id']?>" name="id">
                                <label for="birth_date">Tug'ilgan sanasi</label>
                                <input type="date"  value="<?=$pupil['birth_date']?>" name="birth_date" id="birth_date"  class="form-control" required>
                            </div>
                            <div class="col-4">
                                <label for="name">Ismi</label>
                                <input type="text" name="name"   value="<?=$pupil['name']?>" id="name" class="form-control" required>
                                <label for="grade">Nechanchi kursda o'qiydi</label>
                                <input type="number" name="grade"   value="<?=$pupil['grade']?>" id="grade" class="form-control" required>
                                <label for="faculty">Qaysi yo'nalishda o'qiydi</label>
                                <select type="text" name="faculty"  id="faculty" class="form-control" required>
                                    <option value="">......Yo'nalish tanlang......</option>
                                    <?php foreach ($items as $fac):?>
                                        <option value="<?=$fac['id']?>" <? if($fac['faculty']==$pupil['faculty']) echo "selected"?>><?=$fac['name']?></option>
                                    <?php endforeach;?>
                                </select>


                            </div>
                            <div class="col-4">
                                <label for="middlename">Sharifi</label>
                                <input type="text" name="middlename" id="middlename"  value="<?=$pupil['middlename']?>" class="form-control" required>
                                <label for="text">Telefon raqami</label>
                                <input type="number"  name="phone" id="phone"  value="<?=$pupil['phone']?>" class="form-control" required>

                            </div>
                        </div>
                        <button type="reset"  class="btn-sm btn btn-secondary mt-3" data-dismiss="modal">Tozalash</button>
                        <button type="submit" class="btn-sm mt-3 btn btn-primary">Saqlash</button>
                    </form>
                </div>
            </div>
        <?php endif;?>

<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success:</strong> <?php echo $_SESSION['success']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;?>
<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error:</strong> <?php echo $_SESSION['error']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; session_destroy()?>
    <div class="row">
        <div class="col">
            <h2 class="text-center">O'quvchilar</h2>
        </div>
    </div>
        <div class="row m-2">
            <div class="col">
                <a href="#" class="btn btn-sm btn-info float-right"  data-toggle="modal" data-target="#exampleModal">O'quvchi qo'shish</a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <table class="table table-bordered table-hover text-center  table-striped">
                    <thead>
                        <tr>
                            <?php foreach ($pupils[0] as $key =>$pupil):?>
                                <td><?=$key;?></td>
                            <?php endforeach;?>
                            <th>O'chirish</th>
                            <th>Tahrirlash</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pupils as $pupil_it):?>
                        <tr>
                            <?php foreach ($pupil_it as $key =>$pupil):?>
                            <td><?=$pupil;?></td>
                            <?php endforeach;?>
                            <td><a href="/pupils.php?action=delete&id=<?=$pupil_it['id']?>" id="<?=$pupil_it['id']?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                            <td><a href="/pupils.php?action=edit&id=<?=$pupil_it['id']?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">O'quvchi qo'shish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                           <form action="<?=$_SERVER['PHP_SELF']?>" method="get" class="form form-group">
                               <div class="row">
                                   <div class="col-4">
                                       <label for="surname">Familiyasi</label>
                                       <input type="text" name="surname" id="surname" class="form-control" required>

                                       <label for="address">Manzili</label>
                                       <input type="text" name="address" id="address" class="form-control" required>
                                       <input type="hidden" value="add" name="action">
                                       <label for="birth_date">Tug'ilgan sanasi</label>
                                       <input type="date"  name="birth_date" id="birth_date"  class="form-control" required>
                                   </div>
                                   <div class="col-4">
                                       <label for="name">Ismi</label>
                                       <input type="text" name="name"  id="name" class="form-control" required>
                                       <label for="grade">Nechanchi kursda o'qiydi</label>
                                       <input type="number" name="grade"  id="grade" class="form-control" required>
                                       <label for="faculty">Qaysi yo'nalishda o'qiydi</label>
                                       <select type="text" name="faculty"  id="faculty" class="form-control" required>
                                           <option value="">......Yo'nalish tanlang......</option>
                                                <?php foreach ($items as $fac):?>
                                                    <option value="<?=$fac['id']?>"><?=$fac['name']?></option>
                                                <?php endforeach;?>
                                       </select>


                                   </div>
                                   <div class="col-4">
                                       <label for="middlename">Sharifi</label>
                                       <input type="text" name="middlename" id="middlename" class="form-control" required>
                                       <label for="text">Telefon raqami</label>
                                       <input type="text"  name="phone" id="phone" class="form-control" required>

                                   </div>
                               </div>
                               <button type="reset"  class="btn-sm btn btn-secondary mt-3" data-dismiss="modal">Tozalash</button>
                               <button type="submit" class="btn-sm mt-3 btn btn-primary">Saqlash</button>
                           </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Yopish</button>
                </div>
            </div>
        </div>
    </div>
<?php include __DIR__."/components/footer.php"?>