<?php
require "./includes/db.inc.php";
require "./actions/faculty.php";
$result = mysqli_query($connection, "select * from faculty");
$faculty = [];
while($res =mysqli_fetch_assoc($result)){
    $faculty[] =$res;
}
//print_r($faculty);
?>

<?php include "./components/navbar.php"?>
<?php
if($_GET['action'] == 'edit' && isset($_GET['id']) ):
    ?>
    <?php $sql="select * from faculty where id=".$_GET['id'];
    $result = @mysqli_query($connection, $sql);
    if($result) {
        $faculty_one = mysqli_fetch_assoc($result);

    }else{
        session_start();
        $_SESSION['error']="Bunday Dars yo'q";
    }
    ?>
    <div class="row">
        <div class="col">
            <h2 class="text-center">Yo'nalish nomini o'zgartirish</h2>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="get" class="form form-group">
                <div class="row">
                    <div class="col">
                        <label for="id">Yo'nalish kodi</label>
                        <input type="number" id="id" class="form-control" value="<?=$faculty_one['id']?>" disabled>
                        <input type="hidden"  name="id" class="form-control" value="<?=$faculty_one['id']?>">
                    </div>
                    <div class="col">
                        <label for="surname">Yo'nalish nomi</label>
                        <input type="text" name="name" id="surname" value="<?=$faculty_one['name']?>" class="form-control" required>
                        <input type="hidden" value="edit-data" name="action">

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
            <h2 class="text-center">Yo'nalishlar</h2>
        </div>
    </div>
    <div class="row m-2">
        <div class="col">
            <a href="#" class="btn btn-sm btn-info float-right"  data-toggle="modal" data-target="#exampleModal">Yo'nalish qo'shish</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-bordered table-hover text-center  table-striped">
                <thead>
                <tr>
                    <?php foreach ($faculty[0] as $key => $faculty_one):?>
                        <td><?=$key;?></td>
                    <?php endforeach;?>
                    <th>O'chirish</th>
                    <th>Tahrirlash</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($faculty as $faculty_it):?>
                    <tr>
                        <?php foreach ($faculty_it as $key => $faculty_one):?>
                            <td><?=$faculty_one;?></td>
                        <?php endforeach;?>
                        <td><a href="/faculty.php?action=delete&id=<?=$faculty_it['id']?>" id="<?=$faculty_it['id']?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                        <td><a href="/faculty.php?action=edit&id=<?=$faculty_it['id']?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yo'nalish qo'shish</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="<?=$_SERVER['PHP_SELF']?>" method="get" class="form form-group">
                        <div class="row mb-4">
                            <div class="col">
                                <label for="name">Yo'nalish nomi</label>
                                <input type="text" name="name" id="name" class="form-control ">
                                <input type="hidden" value="add" name="action">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-secondary">Saqlash</button>
                        <button type="reset" class="btn btn-primary">tozalash</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php include __DIR__."/components/footer.php"?>