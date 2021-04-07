<?php
require __DIR__."/includes/db.inc.php";
require "./actions/lessons.php";
$result = mysqli_query($connection, "select * from lessons_view");
$items = [];
while($res =mysqli_fetch_assoc($result)){
    $items[] =$res;
}
?>
<?php include "./components/navbar.php"?>
    <!--MA'lumot olish bazadam ---->
<?php
$sql="select * from pupils";
$result = mysqli_query($connection, $sql);
$pupils = [];
while($res =mysqli_fetch_assoc($result)){
    $pupils[] =$res;
}
$sql="select * from employees";
$result = mysqli_query($connection, $sql);
$employees = [];
while($res =mysqli_fetch_assoc($result)){
    $employees[] =$res;
}
$sql="select * from subjects";
$result = mysqli_query($connection, $sql);
$subjects = [];
while($res =mysqli_fetch_assoc($result)){
    $subjects[] =$res;
}
?>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Dars qo'shish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="<?=$_SERVER['PHP_SELF']?>" method="get" class="form form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="lessoon_pupil">O'quvchi tanlash</label>
                                <select type="text" name="pupil_id" id="lessoon_pupil" class="form-control" required>
                                    <option>............O'quvchi tanlang.......</option>
                                    <?php foreach ($pupils as $pupil):?>
                                        <option value="<?=$pupil['id']?>"><?=$pupil['surname']." ".$pupil['name']." ".$pupil['middlename']?></option>
                                    <?php endforeach;?>
                                </select>
                                <input type="hidden" name="action" value="add">
                                <label for="lessoon_pupil">Dars kuni</label>
                                <?php $week=['Dushanba', 'Seshanba','Chorshanba', 'Payshanba', 'Juma', 'Shanba' ] ?>
                                <select type="text" name="day_of_week" value="Dushanba" id="lessoon_pupil" class="form-control" required>
                                    <option>--Hafta kunini tanlang</option>
                                    <?php foreach ($week as $day): ?>
                                        <option  value="<?=$day?>"><?=$day?></option>
                                    <?php endforeach; ?>
                                </select>


                            </div>
                            <div class="col-4">
                                <label for="lessoon_pupil">O'qituvchi tanlash</label>
                                <select type="text" name="employee_id" id="lessoon_pupil" class="form-control" required>
                                    <option>............O'qituvchi tanlang.......</option>
                                    <?php foreach ($employees as $emp):?>
                                        <option value="<?=$emp['id']?>"><?=$emp['surname']." ".$emp['name']." ".$emp['middlename']?></option>
                                    <?php endforeach;?>
                                </select>

                                <label for="lessoon_pupil">Juflik tartib raqami(para)[1..8]</label>
                                <input type="number"  name="para" class="form-control" min="1" max="8" placeholder="Juftlik tartibini kiriting" required>
                            </div>
                            <div class="col-4">
                                <label for="lessoon_pupil">Fan tanlash</label>
                                <select type="text" name="subject_id" id="lessoon_pupil" class="form-control" required>
                                    <option>--Fan tanlang --</option>
                                    <?php foreach ($subjects as $sbj):?>
                                        <option value="<?=$sbj['id']?>"><?=$sbj['name']?></option>
                                    <?php endforeach;?>
                                </select>
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
<?php
if($_GET['action']=='edit' && isset($_GET['id'])):
?>
<?php
$id=$_GET['id'];
    $sql="select * from lessons where id=".$id;
    $result = mysqli_query($connection, $sql);
    $lesson = mysqli_fetch_assoc($result);
    print_r($lesson);
    ?>
<div class="row">
    <div class="col">
        <form action="<?=$_SERVER['PHP_SELF']?>" method="get" class="form form-group">
            <div class="row">
                <div class="col-4">
                    <label for="lessoon_pupil">O'quvchi tanlash</label>
                    <select type="text" name="pupil_id" id="lessoon_pupil" class="form-control" required>
                        <option>............O'quvchi tanlang.......</option>
                        <?php foreach ($pupils as $pupil):?>
                            <option <?php if($lesson['pupil_id'] == $pupil['id']) echo "selected"?>  value="<?=$pupil['id']?>"><?=$pupil['surname']." ".$pupil['name']." ".$pupil['middlename']?></option>
                        <?php endforeach;?>
                    </select>
                    <input type="hidden" name="action" value="edit-data">
                    <input type="hidden" name="id" value="<?=$lesson['id']?>">
                    <label for="lesson_pupil">Dars kuni</label>
                    <select type="text" name="day_of_week" value="Dushanba" id="lessoon_pupil" class="form-control" required>
                        <option>--Hafta kunini tanlang--</option>
                        <?php foreach ($week as $day): ?>
                        <option  value="<?=$day;?>" <?php if($lesson['day_of_week']==$day) echo "selected"; ?>><?=$day?></option>
                        <?php endforeach; ?>

                    </select>


                </div>
                <div class="col-4">
                    <label for="lessoon_pupil">O'qituvchi tanlash</label>
                    <select type="text" name="employee_id" id="lessoon_pupil" class="form-control" required>
                        <option>............O'qituvchi tanlang.......</option>
                        <?php foreach ($employees as $emp):?>
                            <option value="<?=$emp['id']?>" <?php if($emp['id']==$lesson['employee_id']) echo  "selected"; ?>><?=$emp['surname']." ".$emp['name']." ".$emp['middlename']?></option>
                        <?php endforeach;?>
                    </select>

                    <label for="lessoon_pupil">Juflik tartib raqami(para)[1..8]</label>
                    <input type="number" value="<?=$lesson['para']?>"  name="para" class="form-control" min="1" max="8" placeholder="Juftlik tartibini kiriting" required>
                </div>
                <div class="col-4">
                    <label for="lessoon_pupil">Fan tanlash</label>
                    <select type="text" name="subject_id" id="lessoon_pupil" class="form-control" required>
                        <option>--Fan tanlang --</option>
                        <?php foreach ($subjects as $sbj):?>
                            <option value="<?=$sbj['id']?>" <?php if($lesson['subject_id'] == $sbj['id']) echo "selected" ?>><?=$sbj['name']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <button type="reset"  class="btn-sm btn btn-secondary mt-3" data-dismiss="modal">Tozalash</button>
            <button type="submit" class="btn-sm mt-3 btn btn-primary">Saqlash</button>
        </form>
    </div>
</div>
<?php endif;  ?>
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
        <h2 class="text-center">Darslar</h2>
    </div>
</div>
    <div class="row m-2">
        <div class="col">
            <a href="#" class="btn btn-sm btn-info float-right"  data-toggle="modal" data-target="#exampleModal">dars qo'shish</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover text-center  table-striped">
                <thead>
                <tr>
                    <th>id</th>
                    <th colspan="3">O'qituvchi FISH</th>
                    <th colspan="3">O'quvchi FISH</th>

                    <th>Fan nomi</th>
                    <th>Dars kuni</th>
                    <th>juftlik tartibi</th>
                    <th>O'chirish</th>
                    <th>Tahrirlash</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($items as $item):?>
                    <tr>
                        <td><?=$item['id']?></td>
                        <td><?=$item['employee_surname']?></td>
                        <td><?=$item['employee_name']?></td>
                        <td><?=$item['employee_middlename']?></td>
                        <td><?=$item['pupils_surname']?></td>
                        <td><?=$item['pupils_name']?></td>
                        <td><?=$item['pupils_middlename']?></td>
                        <td><?=$item['subject']?></td>
                        <td><?=$item['day_of_week']?></td>
                        <td><?=$item['para']?></td>
                        <td><a href="/lessons.php?action=delete&id=<?=$item['id']?>" id="<?=$item['shtrix_kodi']?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                        <td><a href="/lessons.php?action=edit&id=<?=$item['id']?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__."/components/footer.php"?>