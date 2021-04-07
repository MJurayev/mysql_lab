<?php
require __DIR__."/includes/db.inc.php";
require  "./actions/marks.php";

$show_query="select * from marks_view";

$result = mysqli_query($connection, $show_query);

$marks = [];
while($res =mysqli_fetch_assoc($result)){
    $marks[] =$res;
}
?>
<?php include "./components/navbar.php"?>
<?php
$sql="select * from pupils";
$result = mysqli_query($connection, $sql);
$pupils = [];
while($res =mysqli_fetch_assoc($result)){
    $pupils[] =$res;
}
$sql="select * from subjects";
$result = mysqli_query($connection, $sql);
$subjects = [];
while($res =mysqli_fetch_assoc($result)){
    $subjects[] =$res;
}
?>
<?php
if($_GET['action']=='edit' && isset($_GET['id'])):
    ?>
    <?php
    $id=$_GET['id'];
    $sql="select * from marks where id=".$id;
    $result = mysqli_query($connection, $sql);
    $mark_one = mysqli_fetch_assoc($result);
    print_r($mark_one);
    ?>
    <div class="row">
        <div class="col">
            <form action="<?=$_SERVER['PHP_SELF']?>" method="get" class="form form-group">
                <div class="row">
                    <div class="col-4">
                        <label for="lessoon_pupil">O'quvchi tanlash</label>
                        <select type="text" name="pupil_id" id="lessoon_pupil" class="form-control" required>
                            <option>---O'quvchi tanlang---</option>
                            <?php foreach ($pupils as $pupil):?>
                                <option value="<?=$pupil['id']?>" <?php if($pupil['id']==$mark_one['pupil_id']) echo "selected";?>><?=$pupil['surname']." ".$pupil['name']." ".$pupil['middlename']?></option>
                            <?php endforeach;?>
                        </select>
                        <input type="hidden" name="action" value="add">
                    </div>

                    <div class="col-4">
                        <label for="lessoon_pupil">Fan tanlash</label>
                        <select type="text" name="subject_id" id="lessoon_pupil" class="form-control" required>
                            <option>--Fan tanlang --</option>
                            <?php foreach ($subjects as $sbj):?>
                                <option value="<?=$sbj['id']?>"  <?php if($sbj['id']==$mark_one['lesson_id']) echo "selected";?>><?=$sbj['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="lessoon_pupil">Baho [0-5]</label>
                        <input type="number" value="<?=$mark_one['mark']?>"  name="mark" class="form-control" min="0" max="5" placeholder="Baho.." required>
                    </div>
                </div>
                <button type="reset"  class="btn-sm btn btn-secondary mt-3" data-dismiss="modal">Tozalash</button>
                <button type="submit" class="btn-sm mt-3 btn btn-primary">Saqlash</button>
            </form>
        </div>
    </div>
<?php endif;  ?>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Baho qo'shish</h5>
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
                                    <option>---O'quvchi tanlang---</option>
                                    <?php foreach ($pupils as $pupil):?>
                                        <option value="<?=$pupil['id']?>"><?=$pupil['surname']." ".$pupil['name']." ".$pupil['middlename']?></option>
                                    <?php endforeach;?>
                                </select>
                                <input type="hidden" name="action" value="add">
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
                            <div class="col-4">
                                <label for="lessoon_pupil">Baho [0-5]</label>
                                <input type="number"  name="mark" class="form-control" min="0" max="5" placeholder="Baho.." required>
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
            <h2 class="text-center">Baholar</h2>
        </div>
    </div>
    <div class="row m-2">
        <div class="col">
            <a href="#" class="btn btn-sm btn-info float-right"   data-toggle="modal" data-target="#exampleModal">Baho qo'shish</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover text-center  table-striped">
                <thead>
                <tr>
                    <?php foreach ($marks[0] as $key => $mark):?>
                        <td><?=$key;?></td>
                    <?php endforeach;?>
                    <th>O'chirish</th>
                    <th>Tahrirlash</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($marks as $mark_item):?>
                    <tr>
                        <?php foreach ($mark_item as $key => $mark):?>
                            <td><?=$mark;?></td>
                        <?php endforeach;?>
                        <td><a href="/marks.php?action=delete&id=<?=$mark_item['id']?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                        <td><a href="/marks.php?action=edit&id=<?=$mark_item['id']?>"  class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    </div>

<?php include __DIR__."/components/footer.php"?>