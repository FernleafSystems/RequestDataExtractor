<?php
namespace CarlosReig\Test\RequestDataExtractor;

use CarlosReig\RequestDataExtractor\RequestDataExtractor;

class RequestDataExtractorTest extends \PHPUnit_Framework_TestCase {

	public function testItAcceptsAnArrayInConstructor() {
		$aServerVariables = $this->getDefaultData();

		$oDataExtractor = new RequestDataExtractor( $aServerVariables );
		$this->assertInstanceOf( 'CarlosReig\RequestDataExtractor\RequestDataExtractor', $oDataExtractor );
	}

	protected function getDefaultData() {
		return array(
			'REMOTE_ADDR' => '1.1.1.1',
			'HTTP_USER_AGENT' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36',
		);
	}
}