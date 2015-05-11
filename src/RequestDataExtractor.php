<?php
namespace CarlosReig\RequestDataExtractor;

use CarlosReig\RequestDataExtractor\Exception\BrowserCannotBetExtracted;
use CarlosReig\RequestDataExtractor\Exception\Exception;
use CarlosReig\RequestDataExtractor\Exception\OperatingSystemCannotBetExtracted;
use CarlosReig\RequestDataExtractor\Exception\UserIpCannotBeExtracted;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . "/../vendor/autoload.php";

class RequestDataExtractor {

	protected $aServerVariables;

	const REMOTE_ADDR = 'REMOTE_ADDR';
	const USER_AGENT = 'HTTP_USER_AGENT';

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

	public function getUserBrowser() {
		if ( !isset ( $this->aServerVariables[self::USER_AGENT] ) ) {
			throw new BrowserCannotBetExtracted( sprintf( 'The SERVER variable %s is not available.', self::USER_AGENT ) );
		}

		$sUserAgent = $this->aServerVariables[self::USER_AGENT];
		$oBrowserInfo = parse_user_agent( $sUserAgent );
		return $oBrowserInfo['browser'];
	}

	public function getUserOperatingSystem() {
		if ( !isset ( $this->aServerVariables[self::USER_AGENT] ) ) {
			throw new OperatingSystemCannotBetExtracted( sprintf( 'The SERVER variable %s is not available.', self::USER_AGENT ) );
		}

		$sUserAgent = $this->aServerVariables[self::USER_AGENT];
		$oBrowserInfo = parse_user_agent( $sUserAgent );
		return $oBrowserInfo['platform'];
	}
}