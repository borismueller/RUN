<?php
if (!empty($files)){
	foreach ($files as $file){
		  $fileName = $file->name;
			$fileTag = $file->tags;
			$filePath = $file->path;

			echo '   <div class="object">
			      <div class="item">
			        <div class="item-type">itemtype</div>
			        <div class="item-desc">
			          <div class="item-desc-name">'.$fileName.'</div>
			          <div class="item-desc-icon">icon</div>
			        </div>
			      </div>
			      <div class="tag">
			        <div class="tag-text">'.$fileTag.'</div>
			        <div class="tag-icon">icon</div>
			      </div>
			    </div>';
	}
}
//TODO: plus
?>
