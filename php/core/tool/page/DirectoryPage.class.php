<?php
require_once 'php/core/Page.class.php';

/**
 * Class DirectoryPage
 * 
 * Directory parsing page, handle files and directory depth
 * 
 * @author moustachu
 *
 */
class DirectoryPage extends Page{
	
	/**
	 * Initial directory path to parse
	 * @var array
	 */
	protected $path ;

	/**
	 * Maximum depth to parse 
	 * @var array
	 */
	protected $depth ;

	/**
	 * Items to display
	 * Multi levels array
	 * @var array
	 */
	protected $items ;
	
	/* (non-PHPdoc)
	 * @see www/v1.a/php/core/Page::__contruct()
	 */
	public function DirectoryPage($path, $depth = 0){
		parent::Page() ;
		
		$this->trace("instanciation DirectoryPage") ;
		
		if( ! ( isset($path) && is_dir($path) ){
			throw new Exception("wrong $path parameter [path=".$path."]") ;
		}
		
		$this->setTitle("Directory") ;
		$this->setTemplate("tool/directory.tpl") ;
		
		$this->path = $path ;
		$this->smarty->assign("directory_path",$this->path);
		
		$this->depth = $depth ;
		
		// tableau hébergeant le contenu de la catégorie
		$this->items = $this->parse($this->path) ;
		
		
		
}
	
	/**
	 * Pushing the items list to the template engine at the latest
	 */
	public function display(){
		$this->smarty->assign("directory_items",$this->items) ;
		parent::display() ;
	}
	
	protected function parse( $current_path, $current_depth = 0 ){
		$result = array() ;
		$article_iterator = dir($current_path);
   		
   		while (false !== ($file = $article_iterator->read())) {
  	 		
   			$f_full_path = $article_iterator->path . $file ;
  	 		
  	 		array_push($result,$this->handle($current_path,$current_depth)) ;
   		}
   		
   		$article_iterator->close() ;
   		return $result;
	}
	
	protected function handle( $current_path, $current_depth = 0 ){
		if( is_file($current_path) ){	
 			return $current_path ;
 		} else if( is_dir($current_path) && ( $current_depth < $depth ) ) {
 			return $this->parse($current_path,$current_depth+1) ;
 		}
	}
	
	/**
	 * Code to keep
	 */
	protected function is_media( $file ){
		$file_ext =  strstr($file,".") ;
		$accepted_ext = array(".jpg",".jpeg",".gif",".png") ;
		
		if( $file_ext ){
			return in_array($file_ext,$accepted_ext) ;
		} else {
			return false ;
		}
		
	}
	
	
}

?>