<?php

/************************************************************
/* Custom fields for portfolio
/************************************************************/

/// CREATE METABOXES

	/// GET CUSTOM TYPES FIRST
	$cc_customtypes = of_get_option('md_custom_posts');
	
	if(is_array($cc_customtypes)) {
		foreach($cc_customtypes as $k => $v) {
			$cc_types[$k] = $v['title']; 
		}
	}else{
		$cc_types[1] = "works";
	}
	
	
	add_action( 'admin_init', 'add_work_fields' );
	add_action( 'save_post', 'save_work_custom_values');
	

if ( ! function_exists( 'add_work_fields' ) ) {
	function add_work_fields() {
		global $cc_types;
		
		foreach($cc_types as $foo) {
			add_meta_box( 'works-link-fields', __( "External URL", 'northeme' ), 'works_link_fields', $foo, 'normal', 'high' );
			add_meta_box( 'works-video-fields', __( "Featured Video", 'dronetv' ), 'works_video_field', $foo, 'side', 'default' );
			add_meta_box( 'works-images-fields', __( "Composition", 'northeme' ), 'works_images_fields', $foo, 'normal', 'core' );
			add_meta_box( 'works-additional-fields', __( "Additional Info &amp; Preferences", 'northeme' ), 'works_additional_fields', $foo, 'normal', 'core' );
			add_meta_box( 'works-gallery-fields', __( "Gallery Settings", 'dronetv' ), 'works_gallery_fields', $foo, 'normal', 'core' );
		}
		
		add_meta_box( 'post-gallery-fields', __( "Slider / Gallery", 'northeme' ), 'post_images_fields', 'post', 'normal', 'high' );
		add_meta_box( 'post-quote-fields', __( "Quote", 'northeme' ), 'post_quote_fields', 'post', 'normal', 'high' );
		add_meta_box( 'post-link-fields', __( "Link", 'northeme' ), 'post_link_fields', 'post', 'normal', 'high' );
		add_meta_box( 'post-image-fields', __( "Image", 'northeme' ), 'post_image_fields', 'post', 'normal', 'high' );
		add_meta_box( 'post-video-fields', __( "Video", 'northeme' ), 'post_video_fields', 'post', 'normal', 'high' );
		
		add_meta_box( 'page-type', __( "Select Custom Post Type", 'dronetv' ), 'page_custom_type', 'page', 'side', 'default' );
		add_meta_box( 'page-content-show', __( "Display Main Text Content", 'dronetv' ), 'page_template_content', 'page', 'side', 'default' );
		
		add_meta_box( 'intro-slider-fields', __( "Intro Slider", 'northeme' ), 'intro_images_fields', 'page', 'normal', 'high' );
		
	}
}

	
/// PAGE
if ( ! function_exists( 'page_custom_type' ) ) {
	function page_custom_type() { 
		
		global $cc_types;
		
		$args = array(
						array(
							'type'=>'select',
							'title'=>'Select',
							'name'=>'page-custom-type',
							'desc'=>'',
							'options'=>$cc_types
						)
				);
		return md_create_fields($args);
	}
}




/// PAGE
if ( ! function_exists( 'page_template_content' ) ) {
	function page_template_content() { 
		
		global $cc_types;
		
		$args = array(
						array(
							'type'=>'select',
							'title'=>'Select',
							'name'=>'page-custom-type-text',
							'desc'=>'',
							'options'=>array('none'=>'Disabled', 'top'=>'Above the content', 'bottom'=>'Below the content')
						)
				);
		return md_create_fields($args);
	}
}



///// BLOG


if ( ! function_exists( 'post_images_fields' ) ) {
	function post_images_fields() { 
		$args = array(	
						array(
							'type'=>'info-array-post',
							'desc'=>__('<span class="imghelp" style="font-size:11px;line-height:17px; float:left; width:100%; display:none"><strong>Images :</strong> Click to "Add New Image" button to upload image(s) or select an image from your WP image library. Adding multiple images is allowed and images/videos can be re-ordered once they\'ve added to your project. <br>By default, images will be displayed up to <strong>1350px</strong> width in Full Width layout, and 840px width in Left Aligned layout at your project canvas. <br>
							
							<br><br><strong>Videos :</strong> Click to "Add New Video" button to add video embed code which is generated by video service website such as youtube, vimeo, dailymotion. <br>Embed video size will be ignored and your videos will be automatically stretched to your project canvas with preserved aspect ratio. <br><strong>NOTE :</strong> You MUST click update button to save all changes once you\'ve added the project assets</span>','northeme')
						),array(
							'type'=>'imagearr',
							'title'=>'',
							'name'=> 'work-media',
							'desc'=>''
						)
				);
		return md_create_fields($args);
	}

}
	
	


if ( ! function_exists( 'intro_images_fields' ) ) {
	function intro_images_fields() { 
		$args = array(	
						array(
							'type'=>'info-array-intro',
							'desc'=>__('<span class="imghelp" style="font-size:11px;line-height:17px; float:left; width:100%; display:none"><strong>Images :</strong> Click to "Add New Image" button to upload image(s) or select an image from your WP image library. Adding multiple images is allowed and images/videos can be re-ordered once they\'ve added to your project. <br>By default, images will be displayed up to <strong>1350px</strong> width in Full Width layout, and 840px width in Left Aligned layout at your project canvas. <br>
							
							<br><br><strong>Videos :</strong> Click to "Add New Video" button to add video embed code which is generated by video service website such as youtube, vimeo, dailymotion. <br>Embed video size will be ignored and your videos will be automatically stretched to your project canvas with preserved aspect ratio. <br><strong>NOTE :</strong> You MUST click update button to save all changes once you\'ve added the project assets</span>','northeme')
						),array(
							'type'=>'introarr',
							'title'=>'',
							'name'=> 'work-media',
							'desc'=>''
						)
				);
		return md_create_fields($args);
	}

}
	
	
if ( ! function_exists( 'post_video_fields' ) ) {
	function post_video_fields() { 
		$args = array(
						array(
							'type'=>'info',
							'desc'=>'Following fields allows you to display additional information about your project.'
						),
						array(
							'type'=>'tarea',
							'title'=>'Video Embed',
							'name'=>'work-video',
							'desc'=>''
						)
				);
		return md_create_fields($args);
	}
}

if ( ! function_exists( 'post_image_fields' ) ) {
	function post_image_fields() { 
		$args = array(
						array(
							'type'=>'info',
							'desc'=>'Image post format uses featured image. In order to add image, use featured image panel.'
						)
				);
		return md_create_fields($args);
	}
}


if ( ! function_exists( 'post_quote_fields' ) ) {
	function post_quote_fields() { 
		$args = array(
						array(
							'type'=>'info',
							'desc'=>''
						),
						array(
							'type'=>'tarea',
							'title'=>'Quote',
							'name'=>'work-quote',
							'desc'=>''
						)
				);
		return md_create_fields($args);
	}
}



if ( ! function_exists( 'post_link_fields' ) ) {
	function post_link_fields() { 
		$args = array(
						array(
							'type'=>'info',
							'desc'=>''
						),
						array(
							'type'=>'select',
							'title'=>'Target',
							'name'=>'work-link-target',
							'desc'=>'',
							'options'=>array('_blank'=>'Open in new window', '_self'=>'Open in same window')
						),
						array(
							'type'=>'tfield',
							'title'=>'Link',
							'name'=>'work-link',
							'desc'=>''
						)
				);
		return md_create_fields($args);
	}
}





/////// WORKS

if ( ! function_exists( 'works_video_field' ) ) {
	function works_video_field() { 
		
		global $cc_types;
		
		$args = array(
						array(
							'type'=>'tareavid',
							'title'=>'Video Embed Code',
							'name'=>'work-featured-video',
							'desc'=>'Featured Image will be ignored'
						)
				);
		return md_create_fields($args);
	}
}


if ( ! function_exists( 'works_gallery_fields' ) ) {
	function works_gallery_fields() { 
		$args = array(
						array(
							'type'=>'info',
							'desc'=>'Following settings will be applied if "Gallery" is selected as your Composition Type. For advanced gallery settings, navigate Workality > Gallery section.'
						),
						array(
							'type'=>'select',
							'title'=>'Transparent Canvas',
							'name'=>'work-gallery-canvas-transparent',
							'desc'=>'',
							'options'=>array(0=>'Deactivated', 1=>'Activated')
						),
						array(
							'type'=>'color',
							'title'=>'Gallery BG Color',
							'name'=>'work-gallery-bg',
							'desc'=>''
						)
				);
		return md_create_fields($args);
	}
}




if ( ! function_exists( 'works_link_fields' ) ) {
	function works_link_fields() { 
		$args = array(
						array(
							'type'=>'info',
							'desc'=>'This field allows you to bind this project to an external link. If activated, visitors will be redirected to the following URL instead of single project page.'
						),
						array(
							'type'=>'select',
							'title'=>'Status',
							'name'=>'work-direct-link-activate',
							'desc'=>'',
							'options'=>array(0=>'Deactivated', 1=>'Activated')
						),
						array(
							'type'=>'select',
							'title'=>'Target',
							'name'=>'work-direct-link-target',
							'desc'=>'',
							'options'=>array('_blank'=>'Open in new window', '_self'=>'Open in same window')
						),
						array(
							'type'=>'tfield',
							'title'=>'URL',
							'name'=>'work-direct-link',
							'desc'=>''
						)
				);
		return md_create_fields($args);
	}
}



if ( ! function_exists( 'md_create_fields' ) ) {		
	function md_create_fields($args) {
		global $post;
		
		$valtype='';
		$valtitle='';
		$valdesc='';
		$valname='';
		$valopt='';
		
		foreach($args as $foo) {
			
			if(isset($foo['type'])) $valtype=$foo['type'];
			if(isset($foo['title'])) $valtitle=$foo['title'];
			if(isset($foo['desc'])) $valdesc=$foo['desc'];
			if(isset($foo['options'])) $valopt=$foo['options'];
			
			if($valtype=='customfield') {
			
				$valname[0]=$foo['name'].'-name[]';
				$valname[1]=$foo['name'].'-val[]';
				$inps = unserialize(get_post_meta( $post->ID, $foo['name'].'-name', true ));
				$inp[0] = $inps[$foo['num']];
				$inps = unserialize(get_post_meta( $post->ID, $foo['name'].'-val', true ));
				$inp[1] = $inps[$foo['num']];
				
				$argsm = array($valtype,$valtitle,$valdesc,$valname,$inp,$valopt);
				echo md_cc_field($argsm);
				
			}else{
			
				if(isset($foo['name'])) $valname=$foo['name'];
					
				$inp = get_post_meta( $post->ID, $valname, true );
				
				$argsm = array($valtype,$valtitle,$valdesc,$valname,$inp,$valopt);
				echo md_cc_field($argsm);
			}
		}
	}
}



if ( ! function_exists( 'works_additional_fields' ) ) {
	function works_additional_fields() { 
		$args = array(
						array(
							'type'=>'info',
							'desc'=>'Following fields allows you to display additional information about your project. Fields will be displayed in following orders in single works page. Also, you\'re able to leave Title fields blank in order to display only values.<br> Quick examples; Title : <strong>Client</strong> / Value : <strong>My Client Name</strong> - Title : <strong>Project URL</strong> - Value : <strong>http://northeme.com</strong>'
						),
						array(
							'type'=>'customfield',
							'title'=>'Custom field',
							'name'=>'work-customs',
							'num'=>0,
							'desc'=>''
						),
						array(
							'type'=>'customfield',
							'title'=>'Custom field',
							'name'=>'work-customs',
							'num'=>1,
							'desc'=>''
						),
						array(
							'type'=>'customfield',
							'title'=>'Custom field',
							'name'=>'work-customs',
							'num'=>2,
							'desc'=>''
						),
						array(
							'type'=>'customfield',
							'title'=>'Custom field',
							'name'=>'work-customs',
							'num'=>3,
							'desc'=>''
						),
						array(
							'type'=>'customfield',
							'title'=>'Custom field',
							'name'=>'work-customs',
							'num'=>4,
							'desc'=>''
						),
						array(
							'type'=>'select',
							'title'=>'Display Project Content',
							'name'=>'work-desc-position',
							'desc'=>'Single post navigation and title placement can be changed via Reframe > Main Layout > "Custom Post Single Page Info/Navigation Placement" option. It can be set as "top" or "right". "Show in sidebar" only works with "right" placement. ',
							'options'=>array('bottom'=>'After project assets', 'top'=>'Before project assets', 'right'=>'Show in sidebar')
						)
				);
		return md_create_fields($args);
	}
}




if ( ! function_exists( 'works_images_fields' ) ) {
	function works_images_fields() { 
		$args = array(	
						array(
							'type'=>'info-array',
							'desc'=>__('<span class="imghelp" style="font-size:11px;line-height:17px; float:left; width:100%; display:none"><strong>Images :</strong> Click to "Add New Image" button to upload image(s) or select an image from your WP image library. Adding multiple images is allowed and images/videos can be re-ordered once they\'re added to your project. By default, images are displayed with <strong>880px</strong> maximum width in project canvas. <br>Smaller images than <strong>880px</strong> will be displayed in their original size as centered. <br>
<strong style="color:#fd0d4d">Important Note :</strong> If "Remove side margins on single project pages" option is enabled, you\'re be able to use 940px image width instead of default 880px.						
							<br><br><strong>Videos :</strong> Click to "Add New Video" button to add video embed code which is generated by video service website such as youtube, vimeo, dailymotion. Embed video size will be ignored and your videos will be automatically stretched to your project canvas with preserved aspect ratio. If you\'re using Gallery mode for your composition, you should add Vimeo or Youtube video URL instead of embed code.  
							<br><br><strong>Text :</strong> You can add text areas into your canvas. Rich text editor allows you to add shortcodes and style your text.
							<br><br><strong>Composition Type :</strong>  By default your images will be placed vertically with following order. Gallery type will create a gallery with following image and video content. If you selected "Gallery" type, "Text" items will be ignored.	
							<br><br><strong>NOTE :</strong> You MUST click update button to save all changes once you\'ve added the project assets
												
							</span>','dronetv')
						),array(
							'type'=>'imagearr',
							'title'=>'',
							'name'=> 'work-media',
							'desc'=>''
						)
				);
		return md_create_fields($args);
	}

}
	


if ( ! function_exists( 'works_video_fields' ) ) {	
	function works_video_fields() { 
		$args = array(	
						array(
							'type'=>'info',
							'desc'=> __('Add video embed code which is generated by video service website such as youtube, vimeo etc. Any video embed code will be accepted. <br>Also you don\'t need to worry about dimensions of your embeded code unless it\'s from Vimeo or Youtube. It will be stretched horizontally in your page with preserved aspect ratio.','northeme')
						),array(
							'type'=>'tarea',
							'title'=>'Video Embed',
							'name'=>'work-video',
							'desc'=>''
						)
				);
		return md_create_fields($args);
	}
}


	
	/////// BOX CREATOR

if ( ! function_exists( 'wrap' ) ) {	
	function wrap($pick, $args=array()) {
		$spid = '';
		if($pick==2) {
			return $sh = '</td></table>';
		}else{
			if($args[0]=='imagearr' || $args[0]=='introarr') { 
				$spid = 'id="md-sortable-media"';
			}
			
			if($args[0]=='imagearr' || $args[0]=='introarr') { 
			
			return $sh = '<input type="hidden" name="work_token" value="'.wp_create_nonce( basename(__FILE__) ).'" /><table class="custom-fields form-table"><tr><td '.$spid.' style="display:block;width:auto">';
			
			}else{
				
				if(isset($args[6]) && $args[6]==1) { 
				
				$val= get_post_meta( $post->ID , $args[3].'-title', true );
				
			return $sh = '<table class="custom-fields form-table"><tr><th><input type="hidden" name="work_token" value="'.wp_create_nonce( basename(__FILE__) ).'" />
			<label for=""><input type="text" name="'.$args[3].'-title" value="'.$val.'" style="width:140px;font-size:11px" placeholder="'.$args[1].'"></label><br /><p>'.__( $args[2], 'dronetv' ).'</p></th><td '.$spid.'>';
				
				}else{
					
			return $sh = '<table class="custom-fields form-table"><tr><th><input type="hidden" name="work_token" value="'.wp_create_nonce( basename(__FILE__) ).'" />
			<label for="">'.$args[1].'</label><br /><p>'.__( $args[2], 'dronetv' ).'</p></th><td '.$spid.'>';	
				
				}
			}
			
		}
	}
}


if ( ! function_exists( 'createToken' ) ) {
	function createToken() { 
		//echo '<input type="hidden" name="work_token" value="'.wp_create_nonce( basename(__FILE__) ).'" />';
	}
}



if ( ! function_exists( 'md_cc_field' ) ) {	
	function md_cc_field ($args=array()) {
		
		global $post;
		
		$res = '';
		$fieldid = 1;
		$idkey = "dpost-";
	
		$idkey = $idkey.$fieldid; 
		if($args[0]=='info' || $args[0]=='info-array' || $args[0]=='info-array-post' || $args[0]=='info-array-intro') {
			
			if($args[0]=='info-array-intro') {
			
			$res .= '<div style="width:97%; padding:30px 15px 0 15px; float:left">
					<a href="javascript:void(0);" class="nhp-opts-upload-intro button-secondary" rel-id="new">Add New Image</a>
					<a href="javascript:void(0);" class="add-more-videos-intro button-secondary" rel-id="new">Add Video</a>
					<br class="clear"><br class="clear">
					</div>';
					
			}elseif($args[0]=='info-array-post') {
			
			$inps = get_post_meta( $post->ID, 'work-comp-type', true );
			
			$res .= '<div style="width:97%; padding:30px 15px 0 15px; float:left">
					<a href="javascript:void(0);" class="nhp-opts-upload button-secondary" rel-id="new">Add New Image</a>
					<a href="javascript:void(0);" class="add-more-videos button-secondary" rel-id="new">Add Video</a>
					<span style="float:right;text-align:right">
						Gallery Type : 
						<select name="work-comp-type" style="width:100px">
							<option value="1" '.selected($inps, 1, false).'>Slider</option>
							<option value="2" '.selected($inps, 2, false).'>Gallery</option>
						</select>
					</span>
					<br class="clear"><br class="clear">
					</div>';	
			}elseif($args[0]=='info-array') {
			$inps = get_post_meta( $post->ID, 'work-comp-type', true );
				
			$res = '<div style="width:97%; padding:30px 15px 0 15px; float:left">
					<small>Please note that "Text" elements will be ignored if "Gallery" is selected as the Composition Type.</small>
					<br class="clear"><br class="clear">
					<a href="javascript:void(0);" class="nhp-opts-upload button-secondary" rel-id="new">Add New Image</a>
					<a href="javascript:void(0);" class="add-more-videos button-secondary" rel-id="new">Add Video</a>
					<a href="javascript:void(0);" class="add-more-text button-secondary" rel-id="new">Add Text</a>
					
					<span style="float:right;text-align:right">
						Composition Type : 
						<select name="work-comp-type" style="width:100px">
							<option value="1" '.selected($inps, 1, false).'>Default</option>
							<option value="2" '.selected($inps, 2, false).'>Gallery</option>
						</select>
					</span>
					<br class="clear"><br class="clear">
					'.$args[2].'
					</div>';		
			}else{
			$res .= '<table class="custom-fields form-table"><tr><td colspan="2"><h4>'.$args[2].'</h4></td></tr></table>';
			}
		}else{
		$res .= wrap(1,$args);
		$res .= fieldType($args);
		$res .= wrap(2);
		}
		$fieldid ++;
		
		return $res;
	}
}



if ( ! function_exists( 'fieldType' ) ) {
	function fieldType($args) {
		
		global $post;
		
		$type = $args[0];
		$key = $args[3];
		$val = $args[4];
		$output = '';
		
		if($type=='tarea' || $type=='tareavid') {
			$output= '<textarea id="'.$key.'" cols="60" rows="3" name="'.$key.'">'.$val.'</textarea>';
			if($type=='tareavid') { 
				$output .= '<div style="width:170px" class="fitvids">'.html_entity_decode($val).'</div>';
			}
			return $output;
		}
		if($type=='color') {
			$output .= '<div id="' . $key . '_picker" class="colorSelector"><div style="background-color: '.$val.'"></div></div>';
		    $output .= '<input class="of-color" name="'.$key.'" id="'. $key .'" type="text" style="width: 80px;padding: 5px;margin-top: 0px;margin-left: 5px;" value="'. $val .'" />';
			return  $output;
		}
		if($type=='select') {
			
			$output .= '<select id="'.$key.'" name="'.$key.'">';
				foreach($args[5] as $k=>$v) {
					if($val==$k) { $sel1 = 'selected'; }else{ $sel1= '';}
					$output .= '<option value="'.$k.'" '.$sel1.'>'.$v.'</option>';
				}
			$output .= '</select>';
			return $output;
			
		}
		if($type=='tfield') {
			return $output= '<input id="'.$key.'" class="upload" type="text" name="'.$key.'" value="'.$val.'" />';
		}
		if($type=='checkbox') {
			return $output= '<input id="'.$key.'" class="upload" type="checkbox" name="'.$key.'" value="1" '.checked($val,1,false).'" />';
		}
		if($type=='customfield') {
			return $output= '<input id="'.$key[0].'" class="upload" type="text" name="'.$key[0].'" placeholder="Title" style="width:180px" value="'.htmlspecialchars(stripslashes(@$val[0]), ENT_QUOTES, "UTF-8").'" />
			<input id="'.$key[1].'" class="upload" type="text" name="'.$key[1].'" style="width:500px;" placeholder="Value" value="'.htmlspecialchars(stripslashes(@$val[1]), ENT_QUOTES, "UTF-8").'" />';
		}
		if($type=='tfielddate') {
			return $output= '<input id="'.$key.'" class="upload get-datepicker" type="text" name="'.$key.'" value="'.$val.'" />';
		}
		
		if($type=='imagearr') {
			$s1=0;
			$s2=0;
			$s3=0;
			$output = "";
			$media = @unserialize($val);
			$mediacaption = @unserialize(get_post_meta( $post->ID, 'work-media-caption', true ));
			$medialink = @unserialize(get_post_meta( $post->ID, 'work-media-link', true ));
			$medialinktarget = @unserialize(get_post_meta( $post->ID, 'work-media-link-target', true ));
			$medialinkfancy = @unserialize(get_post_meta( $post->ID, 'work-media-fancy', true ));
			$mediavideo = @unserialize(get_post_meta( $post->ID, 'work-media-video', true ));
			$mediatext = @unserialize(get_post_meta( $post->ID, 'work-media-text', true ));
			$mediapalign = @unserialize(get_post_meta( $post->ID, 'work-media-photoalignment', true ));
			
			if(is_array($media)) {
				foreach($media as $v) {
					if($v=='textarea') {
						
					$output .= '<div class="imgarr"><span class="imgside">';
					$output .= '<input type="hidden" name="work-media[]" value="textarea" />';
					
					$output .= '<textarea id="tinymceids-'.$s3.'" cols="60" style="width:600px;height:300px;" class="mceEditor" name="work-media-text[]">'.stripslashes($mediatext[$s3]).'</textarea><br class="clear">';
					$output .= '<a href="javascript:void(0);" class="admin-upload-remove button-secondary" rel-id="work-media-'.$s3.'">'.__('Remove', 'dronetv').'</a>';
					$output .= '</span><br class="clear"></div>';
					$s3++;
					
					
					}elseif($v=='videoembed') {
						
					$output .= '<div class="imgarr"><span class="imgside">';
					$output .= '<input type="hidden" name="work-media[]" value="videoembed" />';
					$output .= '<img width="120" class="screenshot" src="'.ADMIN_IMG_DIRECTORY.'youtube.png" /></span><span>';
					$output .= '<strong>Video Embed</strong><br class="clear" >';
					$output .= '<textarea id="work-media-video-'.$s1.'" cols="60" rows="3" class="video-caption" name="work-media-video[]">'.stripslashes($mediavideo[$s1]).'</textarea><br class="clear">';
					$output .= '<a href="javascript:void(0);" class="admin-upload-remove button-secondary" rel-id="work-media-'.$s1.'">'.__('Remove', 'dronetv').'</a>';
					$output .= '</span><br class="clear"></div>';
					$s1++;
					
					}else{
					
					$output .= '<div class="imgarr"><span class="imgside">';
					$output .= '<input type="hidden" id="work-media-'.$s2.'" name="work-media[]" value="'.$v.'" />';
					$output .= '<div class="imgwindow"><img width="120" class="screenshot" id="sc-'.$s2.'" src="'.$v.'" /></div>';
					$output .= '</span><span>';
					$output .= '<strong>Image Caption</strong><br class="clear" >';
					$output .= '<textarea id="work-media-caption-'.$s2.'" cols="60" style="height:50px;" class="work-caption" name="work-media-caption[]">'.@stripslashes($mediacaption[$s2]).'</textarea>';
					$output .= '<br class="clear"><br class="clear"><small><strong>URL</strong>Optional. If present, image will be linked to the following URL.</small><br class="clear" >';
					$output .= '<input type="text" style="width:200px;" placeholder="E.g. http://www.northeme.com" id="work-media-link-'.$s2.'" name="work-media-link[]" value="'.@stripslashes($medialink[$s2]).'" />';
					
					$output .= '<select id="work-media-link-target-'.$s2.'" name="work-media-link-target[]" class="urlselector">';
					
					$output .= '<option value="_blank" '.selected($medialinktarget[$s2], '_blank', false).'>Open in New Window</option><option value="_self" '.selected($medialinktarget[$s2], '_self', false).'>Open in Same Window</option>';
					
					$output .= '</select>';
					
					
					$prt = '';
					$lnd = '';
					if(isset($mediapalign[$s2]) && $mediapalign[$s2] == 'portrait')  { $prt = 'checked="checked"'; }else{ $lnd = 'checked="checked"'; }
					
					$output .= '<br class="clear"><br class="clear" >
								<label class="radio bloghide"><input type="radio" name="work-media-photoalignment['.$s2.']" '.$lnd.' value="landscape"> Landscape</label>
								<label class="radio bloghide"><input type="radio" name="work-media-photoalignment['.$s2.']" '.$prt.' value="portrait"> Portrait</label>'; 
					
					
					$output .= '<br class="clear" ><br class="clear" ><strong>Lightbox</strong><br class="clear" ><br class="clear" >';
					
					$output .= '<select id="work-media-fancy-'.$s2.'" name="work-media-fancy[]" class="urlselector" style="margin-left:0;">';
					
					$output .= '<option value="0" '.selected($medialinkfancy[$s2], '0', false).'>Default</option>
					<option value="1" '.selected($medialinkfancy[$s2], '1', false).'>Open in Lightbox</option>';
					
					$output .= '</select>';
					
							
					$output .= '<a href="javascript:void(0);" class="admin-upload-remove button-secondary" rel-id="work-media-'.$s2.'">'.__('Remove', 'dronetv').'</a><br class="clear">';
					$output .= '</span><br class="clear"></div>';
					
					
					
					
					$s2++;
					
					}
				}
			}
			return $output;
		}
		
		
		if($type=='introarr') {
			$s1=0;
			$s2=0;
			$s3=0;
			$output = "";
			$media = unserialize($val);
			$mediacaption = unserialize(get_post_meta( $post->ID, 'work-media-caption', true ));
			$medialink = unserialize(get_post_meta( $post->ID, 'work-media-link', true ));
			$medialinktarget = unserialize(get_post_meta( $post->ID, 'work-media-link-target', true ));
			$mediavideo = unserialize(get_post_meta( $post->ID, 'work-media-video', true ));
			$mediavideoogg = unserialize(get_post_meta( $post->ID, 'work-media-video-ogg', true ));
			$mediavideomp4 = unserialize(get_post_meta( $post->ID, 'work-media-video-mp4', true ));
			$mediavideothumb = unserialize(get_post_meta( $post->ID, 'work-media-video-thumb', true ));
			$mediavideotype = unserialize(get_post_meta( $post->ID, 'work-media-video-type', true ));
			
			if(is_array($media)) {
				foreach($media as $v) {
					if($v=='videoembed') {
						
					$output .= '<div class="imgarr"><span class="imgside">';
					$output .= '<input type="hidden" name="work-media[]" value="videoembed" />';
					$output .= '<img width="120" class="screenshot" src="'.ADMIN_IMG_DIRECTORY.'youtube.png" /></span><span style="width:70%">';
					$output .= '<strong>Video Type</strong><br class="clear" >';
					
					$hide1 = '';
					$hide2 = '';
					
					if($mediavideotype[$s1]=='html5') { 
						$hide1 = 'style="display:none"';
						$hide2 = '';
					}else{
						$hide1 = '';
						$hide2 = 'style="display:none"';
					}
					
					
					$output .= '<select name="work-media-video-type[]" class="urlselector videoelement" data-id="'.$s1.'" style="width:120px; margin-left:0;">
						<option value="youtube" '.selected($mediavideotype[$s1], 'youtube', false).'>Youtube</option><option value="vimeo" '.selected($mediavideotype[$s1], 'vimeo', false).'>Vimeo</option></select>
					<br class="clear" ><br class="clear" ><div class="embedvideo'.$s1.'" '.$hide1.'><strong>Video ID</strong><br class="clear" ><small>Please enter Youtube or Vimeo ID. <br>E.g. if your video link is  : http://www.youtube.com/watch?v=GCZrz8siv4Q -> your video ID is GCZrz8siv4Q.</small><br class="clear" ><input id="v'.$s1.'" name="work-media-video[]" value="'.@stripslashes($mediavideo[$s1]).'"></div>';
					
					
					$output .= '<br class="clear" ><div class="html5video'.$s1.'" '.$hide2.'><strong>Video URL (mp4)</strong><br class="clear" ><small>E.g. http://mysite.com/video.mp4</small><br class="clear" ><input id="v'.$s1.'" name="work-media-video-mp4[]" value="'.@stripslashes($mediavideomp4[$s1]).'">
					<br class="clear" ><br class="clear" ><strong>Video URL (ogg - optional)</strong><br class="clear" ><small>If you have ogg version of your video, please enter the URL.</small><br class="clear" ><input id="v'.$s1.'" name="work-media-video-ogg[]" value="'.@stripslashes($mediavideoogg[$s1]).'">
					<br class="clear" ><br class="clear" ><strong>Cover Image</strong><br class="clear" ><small>Image URL for your video E.g. http://</small><br class="clear" ><input id="v'.$s1.'" name="work-media-video-thumb[]" value="'.@stripslashes($mediavideothumb[$s1]).'">
					</div>';
					$output .= '<a href="javascript:void(0);" class="admin-upload-remove button-secondary" rel-id="work-media-'.$s1.'">'.__('Remove', 'dronetv').'</a>';
					$output .= '</span><br class="clear"></div>';
					$s1++;
					
					
					
					}else{
					
					$output .= '<div class="imgarr"><span class="imgside">';
					$output .= '<input type="hidden" id="work-media-'.$s2.'" name="work-media[]" value="'.$v.'" />';
					$output .= '<div class="imgwindow"><img width="120" class="screenshot" id="sc-'.$s2.'" src="'.$v.'" /></div>';
					$output .= '</span><span>';
					$output .= '<strong>Image Caption</strong><br class="clear" >';
					$output .= '<textarea id="work-media-caption-'.$s2.'" cols="60" style="height:50px;" class="work-caption" name="work-media-caption[]">'.@stripslashes($mediacaption[$s2]).'</textarea>';
					$output .= '<br class="clear"><small><strong>URL</strong> (Optional. If present, image will be wrapped with this URL)</small><br class="clear" >';
					$output .= '<input type="text" style="width:200px;" placeholder="E.g. http://www.northeme.com" id="work-media-link-'.$s2.'" name="work-media-link[]" value="'.@stripslashes($medialink[$s2]).'" />';
					
					$output .= '<select id="work-media-link-target-'.$s2.'" name="work-media-link-target[]" class="urlselector">';
					
					$output .= '<option value="_blank" '.selected($medialinktarget[$s2], '_blank', false).'>Open in New Window</option><option value="_self" '.selected($medialinktarget[$s2], '_self', false).'>Open in Same Window</option>';
					
					$output .= '</select>';
					
					$prt = '';
					$lnd = '';
					if(isset($mediapalign[$s2]) && $mediapalign[$s2] == 'portrait')  { $prt = 'checked="checked"'; }else{ $lnd = 'checked="checked"'; }
					
					$output .= '<br class="clear">'; 
								
					$output .= '<a href="javascript:void(0);" class="admin-upload-remove button-secondary" rel-id="work-media-'.$s2.'">'.__('Remove', 'dronetv').'</a><br class="clear">';
					$output .= '</span><br class="clear"></div>';
					$s2++;
					
					}
				}
			}
			return $output;
		}
		
		
	}
}





if ( ! function_exists( 'save_work_custom_values' ) ) {
	function save_work_custom_values( $post_id ) {
		  
		  global $post;
		  // verify if this is an auto save routine. 
		  // If it is our form has not been submitted, so we dont want to do anything
		  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			  return;
	
		  // verify this came from the our screen and with proper authorization,
		  // because save_post can be triggered at other times
		  if(isset($_POST['work_token'])) {
			  if ( !wp_verify_nonce( $_POST['work_token'], basename( __FILE__ ) ) )
				return;
		  }else{
				return;  
		  }
		  
		  // Check permissions
		  if ( 'page' == $_POST['post_type'] ) 
		  {
			if ( !current_user_can( 'edit_page', $post_id ) )
				return;
		  }
		  else
		  {
			if ( !current_user_can( 'edit_post', $post_id ) )
				return;
		  }
	
	
		
			//// Handle custom values
		if( $post->post_type == "page" && $_POST['page_template']=="template-works.php") {
			
			global $custompostvals;
			
			update_post_meta($post->ID, 'page-custom-type-text', $_POST['page-custom-type-text']);
			update_post_meta($post->ID, 'page-custom-type', $_POST['page-custom-type']);
			$cc_customtypes = of_get_option('md_custom_posts',1);
			
			
			if(is_array($cc_customtypes)) {
				$osettings = get_option(OPTIONS);
			}else{
				$osettings['md_custom_posts'][1]=$custompostvals;
			}
			
			$osettings['md_custom_posts'][$_POST['page-custom-type']]['home_url'] = $post->ID;
			
			update_option(OPTIONS, $osettings);
			
		
		}elseif( $post->post_type == "page" && $_POST['page_template']=="template-blog.php") {
			
			update_post_meta($post->ID, 'page-custom-type-text', $_POST['page-custom-type-text']);
				
		}else{
			
				foreach($_POST as $inp => $val) {
					if(strpos($inp,'work-')!==false) {
					
					$itworks=1;
							
					if($inp=='work-media' || $inp=='work-media-caption' || $inp=='work-media-video' || $inp=='work-media-video-type' || $inp=='work-media-video-thumb' || $inp=='work-media-video-mp4' || $inp=='work-media-video-ogg' || $inp=='work-media-text' || $inp=='work-media-link' || $inp=='work-media-fancy' || $inp=='work-media-link-target' || $inp=='work-media-photoalignment' || strpos($inp,'work-customs')!==false) {
						@$varm = addslashes( serialize( $val));
					}else{
						@$varm = stripslashes(htmlspecialchars( $val));
					}
				
					update_post_meta($post->ID, $inp, $varm);
					}
				}	
				
				if(isset($itworks) || $_POST['page_template']=="template-fullslider.php") {	
					if(!isset($_POST['work-media'])) {
						update_post_meta($post->ID, 'work-media', '');	
						update_post_meta($post->ID, 'work-media-caption', '');	
						update_post_meta($post->ID, 'work-media-video', '');	
					}
				}
				
				
		}	
		
	}
}
?>