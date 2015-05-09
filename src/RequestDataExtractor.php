<?php
namespace CarlosReig\RequestDataExtractor;

use CarlosReig\RequestDataExtractor\Exception\UserIpCannotBeExtracted;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . "/../vendor/autoload.php";

class RequestDataExtractor {

	protected $aServerVariables;

	const REMOTE_ADDR = 'REMOTE_ADDR';

	public function __construct( array $aServerVariables = null ) {
		if ( empty( $aServerVariables ) ) {
			$oRequest = Request::createFromGlobals();
			$aServerVariables = $oRequest->server->all();
		}

		$this->aServerVariables = $aServerVariables;
	}

	public function getUserIP() {
		if ( isset( $this->aServerVariables[self::REMOTE_ADDR] ) ) {
			return $this->aServerVariables[self::REMOTE_ADDR];
		}

		throw new UserIpCannotBeExtracted( sprintf( 'The SERVER variable %s is not available.', self::REMOTE_ADDR ) );
	}
}