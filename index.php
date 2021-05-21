<?php
include('header.php');
include('treeview.php');

$treeView = new TreeView('content');
echo $treeView->getTree();
?>
    <div id="folder_jstree"></div>


    <script type="text/javascript">

    $(document).ready(function() {
        $('.treeview').find('ul').hide();
     
        $('.treeview-folder span').click(function() {
            $(this).parent().find('ul:first').toggle('medium');
     
            if ($(this).parent().attr('className') == 'treeview-folder') {
                return;
            }
        });
    });

   </script>

<script type="text/javascript">
            $(function () {
               $('#vidBox').VideoPopUp({
                	backgroundColor: "#17212a",
                	opener: "video1",
                    maxweight: "340",
                    idvideo: "v1"
                });
            });
    </script>

    
<script type="text/javascript">
$(".treeview-file").children().hide();
            $(".treeview-file").click(function() {
                $(this).children().toggle();
            });
    </script>
<?php
include('footer.php');
?>