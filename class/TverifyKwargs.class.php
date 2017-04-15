<?php
trait TverifyKwargs {
	protected function kwargsHasSize(array $kwargs){
		return (array_key_exists( 'width', $kwargs ) && array_key_exists( 'height', $kwargs ));
	}

	protected function getSizeFromKwargs( array $kwargs ){
		return array ( 'width' => $kwargs['width'] ,
				'height' => $kwargs['height'] );
	}

	protected function getSizeFromArgs($width, $height){
		return array ( 'width' => $width, 'height' => $height);
	}
}
?>
