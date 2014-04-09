<?php
/**
 * MslsBlog
 * @author Dennis Ploetner <re@lloc.de>
 * @since 0.9.8
 */

/**
 * Internal representation of a blog
 * @package Msls
 */
class MslsBlog {

	/**
	 * WordPress generates such an object
	 * @var StdClass
	 */
	private $obj;

	/**
	 * Language-code eg. de_DE
	 * @var string
	 */
	private $language;

	/**
	 * Description eg. Deutsch
	 * @var string
	 */
	private $description;

	/**
	 * Constructor
	 * @param StdClass $obj 
	 * @param string description
	 */
	public function __construct( $obj, $description ) {
		if ( is_object( $obj ) ) {
			$this->obj      = $obj;
			$this->language = (string) get_blog_option( 
				$this->obj->userblog_id, 'WPLANG'
			);
		}
		$this->description = (string) $description;
	}

	/**
	 * Get a member of the StdClass-object by name
	 *
	 * The method return <em>null</em> if the requested member does not exists.
	 * @param string $key
	 * @return mixed|null
	 */
	final public function __get( $key ) {
		return( isset( $this->obj->$key ) ? $this->obj->$key : null );
	}

	/**
	 * Get the description stored in this object
	 * 
	 * The method returns the stored language if the description is empty.
	 * @return string
	 */
	public function get_description() {
		return(
			!empty( $this->description ) ?
			$this->description :
			$this->get_language()
		);
	}

	/**
	 * Get the language stored in this object
	 * 
	 * The method returns the string 'us' if there is an empty value in language.  
	 * @return string
	 */
	public function get_language() {
		return( !empty( $this->language ) ? $this->language : 'us' );
	}

	/**
	 * Sort objects helper
	 * @param mixed $a
	 * @param mixed $b
	 * return int
	 */
	static function _cmp( $a, $b ) {
		if ( $a == $b )
			return 0;
		return( $a < $b ? (-1) : 1 );
	}

	/**
	 * Sort objects by language
	 * @param mixed $a
	 * @param mixed $b
	 * return int
	 */
	static function language( $a, $b ) {
		return( self::_cmp( $a->get_language(), $b->get_language() ) );
	}

	/**
	 * Sort objects by description
	 * @param mixed $a
	 * @param mixed $b
	 * return int
	 */
	static function description( $a, $b ) {
		return( self::_cmp( $a->get_description(), $b->get_description() ) );
	}

}
