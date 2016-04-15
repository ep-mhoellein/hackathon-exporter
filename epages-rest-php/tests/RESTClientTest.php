<?php

namespace ep6;

class RESTClientTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @group utility
	 */
    function testConnection()
    {
        $this->assertTrue(RESTClient::connect("www.google.de", "Shopname"));
        $this->assertTrue(RESTClient::connect("www.google.de", "Shopname", "AuthToken"));
        $this->assertFalse(RESTClient::connect("ThisIsNODomain", "Shopname", "AuthToken"));
        $this->assertTrue(RESTClient::connect("www.google.de", "Shopname", "AuthToken", true));
        $this->assertTrue(RESTClient::connect("www.google.de", "Shopname", "AuthToken", false));
    }

	/**
	 * @group utility
	 */
    function testSetRequestMethod()
    {
        $this->assertFalse(RESTClient::setRequestMethod("NOVALIDMETHOD"));
		$this->assertTrue(RESTClient::error());
		$this->assertEquals("RESTC-9", RESTClient::errorNumber());
        $this->assertTrue(RESTClient::setRequestMethod("GET"));
        $this->assertTrue(RESTClient::setRequestMethod("PUT"));
        $this->assertTrue(RESTClient::setRequestMethod("POST"));
        $this->assertTrue(RESTClient::setRequestMethod("DELETE"));
        $this->assertTrue(RESTClient::setRequestMethod("PATCH"));
    }

	/**
	 * @group utility
	 */
    function testSend()
    {
        RESTClient::connect("sandbox.epages.com", "EpagesDevD20150929T075829R63", "icgToyl45PKhmkz6E2PUQOriaCoE5Wzq", true);
        $this->assertNull(RESTClient::send("locale", "NoArray"));
		$this->assertTrue(RESTClient::error());
		$this->assertEquals("RESTC-5", RESTClient::errorNumber());

		RESTClient::disconnect();
		$this->assertNull(RESTClient::send("locale"));
		$this->assertTrue(RESTClient::error());
		$this->assertEquals("RESTC-6", RESTClient::errorNumber());

		RESTClient::connect("sandbox.epages.com", "EpagesDevD20150929T075829R63", "icgToyl45PKhmkz6E2PUQOriaCoE5Wzq", true);
        $this->assertNull(RESTClient::send("NoValidRessource"));
		$this->assertTrue(RESTClient::error());
		$this->assertEquals("RESTC-7", RESTClient::errorNumber());

        $this->assertNotNull(RESTClient::send());
		$this->assertFalse(RESTClient::error());
		$this->assertNull(RESTClient::errorNumber());
    }

	/**
	 * @group utility
	 */
    function testSendWithLocalization()
    {
        RESTClient::connect("sandbox.epages.com", "EpagesDevD20150929T075829R63", "icgToyl45PKhmkz6E2PUQOriaCoE5Wzq", true);
        $this->assertNull(RESTClient::sendWithLocalization("locale", "NoLocale"));
		$this->assertTrue(RESTClient::error());
		$this->assertEquals("RESTC-3", RESTClient::errorNumber());

        $this->assertNull(RESTClient::sendWithLocalization("locale", "NoLocale", "NoArray"));
		$this->assertTrue(RESTClient::error());
		$this->assertEquals("RESTC-3", RESTClient::errorNumber());

        $this->assertNull(RESTClient::sendWithLocalization("locale", "en_GB", "NoArray"));
		$this->assertTrue(RESTClient::error());
		$this->assertEquals("RESTC-5", RESTClient::errorNumber());

		RESTClient::disconnect();
		$this->assertNull(RESTClient::sendWithLocalization("locale", "NoLocale"));
		$this->assertTrue(RESTClient::error());
		$this->assertEquals("RESTC-3", RESTClient::errorNumber());

		RESTClient::disconnect();
		$this->assertNull(RESTClient::sendWithLocalization("locale", "en_GB"));
		$this->assertTrue(RESTClient::error());
		$this->assertEquals("RESTC-6", RESTClient::errorNumber());

		RESTClient::connect("sandbox.epages.com", "EpagesDevD20150929T075829R63", "icgToyl45PKhmkz6E2PUQOriaCoE5Wzq", true);
        $this->assertNull(RESTClient::sendWithLocalization("NoValidRessource", "en_GB"));
		$this->assertTrue(RESTClient::error());
		$this->assertEquals("RESTC-7", RESTClient::errorNumber());

        $this->assertNull(RESTClient::sendWithLocalization("NoValidRessource", "NoLocale"));
		$this->assertTrue(RESTClient::error());
		$this->assertEquals("RESTC-3", RESTClient::errorNumber());

        $this->assertNotNull(RESTClient::sendWithLocalization("locale", "de_DE"));
		$this->assertFalse(RESTClient::error());
		$this->assertNull(RESTClient::errorNumber());
    }

	/**
	 * @group utility
	 */
    function testSetRequestTime()
    {
        $this->assertFalse(RESTClient::setRequestTime("NoInt"));
		$this->assertTrue(RESTClient::error());
		$this->assertEquals("RESTC-10", RESTClient::errorNumber());


        $this->assertFalse(RESTClient::setRequestTime(-1));
		$this->assertTrue(RESTClient::error());
		$this->assertEquals("RESTC-10", RESTClient::errorNumber());


        $this->assertFalse(RESTClient::setRequestTime(600));
		$this->assertFalse(RESTClient::error());
		$this->assertNull("RESTC-10", RESTClient::errorNumber());
    }
}