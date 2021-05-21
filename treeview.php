<?php
class TreeView
{
    private $root;
 
    public function __construct($path)
    {
        $this->root = $path;
    }
 
    public function getTree()
    {
        return $this->createStructure($this->root, true);
    }
 
    private function createStructure($directory, $root)
    {
        $structure = $root ? '<ul class="treeview">' : '<ul>';
 
        $nodes = $this->getNodes($directory);
        foreach ($nodes as $node) {
            $path = $directory.'/'.$node;
            if (is_dir($path) ) {
                $structure .= '<li class="treeview-folder">';
                $structure .= '<span>'.$node.'</span>';
                $structure .= self::createStructure($path, false);
                $structure .= '</li>';
            } else {
                $path = str_replace($this->root.'/', null, $path);
                if (preg_match("/^.*.txt/", $node))
                {
                    $structure .= '<li class="treeview-file">'.$node;
                    $content = file_get_contents($directory.'/'.$node );
                    $structure .='<p class="readme-content">'.$content.'</p>';
                    $structure .= '</li>';
                }else if(preg_match("/^.*.mp4/", $node)){
                    $structure .= '<li class="treeview-file">'.$node;
                    $structure .= '<a href="javascript:void(0)" id="video1"></a>
                        <br />
                        <div id="vidBox">
                            <div id="videCont">
                            <video autoplay id="v1" loop controls>
                            <source src="'.$directory.'/'.$node.'" type="video/mp4">
                        </video>
                    </div>
                </div>';
                $structure .= '</li>';
                }else if(preg_match("/^.*.jpg/", $node)){
                    $structure .= '<li class="treeview-file">'.$node;
                    $structure .= '<img src="'.$directory.'/'.$node.'" height="10%" width="10%" onClick="window.open(this.src)" style="display: none;" />';
                    $structure .= '</li>';
                }

            }
        }
 
        return $structure.'</ul>';
    }
 
    private function getNodes($directory = null)
    {
        $folders = [];
        $files = [];
 
        $nodes = scandir($directory);
        foreach ($nodes as $node) {
            if (!$this->exclude($node)) {
                if (is_dir($directory.'/'.$node)) {
                    $folders[] = $node;
                } else {
                    $files[] = $node;
                }
            }
        }
 
        return array_merge($folders, $files);
    }
 
    private function exclude($filename)
    {
        return in_array($filename, ['.', '..', 'index.php', '.htaccess', '.DS_Store']);
    }
}
?>