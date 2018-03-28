<?php
$userxmlstr = <<<XML
<?xml version="1.0" encoding="utf-8" ?>
<users xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
       xsi:noNamespaceSchemaLocation="users.xsd">
    <user role="client" id="5001">
        <name>
            <first>Jaime</first>
            <last>Hardy</last>
        </name>
        <username>JaimeH</username>
        <password>jaime003</password>
        <location>
            <city>Toronto</city>
            <province>Ontario</province>
            <country>Canada</country>
            <zipCode>L6T2M5</zipCode>
        </location>
    </user>
    <user role="staff" id="1009">
        <name>
            <first>Kelly</first>
            <middle>T</middle>
            <last>Peterson</last>
        </name>
        <username>KellyP</username>
        <password>kelly006</password>
        <location>
            <city>Vancouver</city>
            <province>British Columbia</province>
            <country>Canada</country>
            <zipCode>V5H3Z7</zipCode>
        </location>
    </user>
    <user role="client" id="5003">
        <name>
            <first>Candice</first>
            <last>Porter</last>
        </name>
        <username>CandiceP</username>
        <password>candice009</password>
        <location>
            <city>Montreal</city>
            <province>Quebec</province>
            <country>Canada</country>
            <zipCode>H1A0A1</zipCode>
        </location>
    </user>
</users>
XML;
?>