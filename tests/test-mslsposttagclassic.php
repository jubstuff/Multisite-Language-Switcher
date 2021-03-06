<?php
/**
 * Tests for MslsPostTagClassic
 *
 * @author Dennis Ploetner <re@lloc.de>
 * @package Msls
 */

use lloc\Msls\MslsPostTagClassic;
use lloc\Msls\MslsOptions;
use lloc\Msls\MslsBlogCollection;

/**
 * WP_Test_MslsPostTagClassic
 */
class WP_Test_MslsPostTagClassic extends Msls_UnitTestCase {

	public function get_test() {
		$options    = MslsOptions::instance();
		$collection = MslsBlogCollection::instance();

		return new MslsPostTagClassic( $options, $collection );
	}

	/**
	 * Verify the static the_input-method
	 */
	public function test_the_input_method() {
		$obj = $this->get_test();

		$tag = new StdClass;
		$tag->term_id = 1;
		$this->assertInternalType( 'boolean', $obj->the_input( $tag, 'test', 'test' ) );
	}
}
