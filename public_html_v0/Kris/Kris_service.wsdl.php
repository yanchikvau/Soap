<?php
/**
 * Kris_service.wsdl.php
 */
header("Content-Type: text/xml; charset=utf-8");
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
?>
<definitions xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
             xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/"
             xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
             xmlns:mime="http://schemas.xmlsoap.org/wsdl/mime/"
             xmlns:tns="http://<?=$_SERVER['HTTP_HOST']?>/"
             xmlns:xs="http://www.w3.org/2001/XMLSchema"
             xmlns:soap12="http://schemas.xmlsoap.org/wsdl/soap12/"
             xmlns:http="http://schemas.xmlsoap.org/wsdl/http/"
             name="SmsWsdl"
             xmlns="http://schemas.xmlsoap.org/wsdl/">
    <types>
        <xs:schema elementFormDefault="qualified"
                   xmlns:tns="http://schemas.xmlsoap.org/wsdl/"
                   xmlns:xs="http://www.w3.org/2001/XMLSchema"
                   targetNamespace="http://<?=$_SERVER['HTTP_HOST']?>/">
            <xs:complexType name="Message">
                <xs:sequence>
                    <xs:element name="phone" type="xs:string" minOccurs="1" maxOccurs="1" />
                    <xs:element name="text" type="xs:string" minOccurs="1" maxOccurs="1" />
                    <xs:element name="date" type="xs:dateTime" minOccurs="1" maxOccurs="1" />
                    <xs:element name="type" type="xs:decimal" minOccurs="1" maxOccurs="1" />
                </xs:sequence>
            </xs:complexType>
            <xs:complexType name="MessageList">
                <xs:sequence>
                    <xs:element name="message" type="Message" minOccurs="1" maxOccurs="unbounded" />
                </xs:sequence>
            </xs:complexType>
            <xs:element name="Request">
                <xs:complexType>
                    <xs:sequence>
                        <xs:element name="messageList" type="MessageList" />
                    </xs:sequence>
                </xs:complexType>
            </xs:element>
            <xs:element name="Response">
                <xs:complexType>
                    <xs:sequence>
                        <xs:element name="status" type="xs:boolean" />
                    </xs:sequence>
                </xs:complexType>
            </xs:element>
        </xs:schema>
    </types>

    <!-- Сообщения процедуры sendSms -->
    <message name="sendOrderRequest">
        <part name="Request" element="tns:Request" />
    </message>
    <message name="sendOrderResponse">
        <part name="Response" element="tns:Response" />
    </message>

    <!-- Привязка процедуры к сообщениям -->
    <portType name="OrderServicePortType">
        <operation name="sendOrder">
            <input message="tns:sendOrderRequest" />
            <output message="tns:sendOrderResponse" />
        </operation>
    </portType>

    <!-- Формат процедур веб-сервиса -->
    <binding name="SmsServiceBinding" type="tns:OrderServicePortType">
        <soap:binding transport="http://schemas.xmlsoap.org/soap/http" />
        <operation name="sendOrder">
            <soap:operation soapAction="" />
            <input>
            <soap:body use="literal" />
            </input>
            <output>
                <soap:body use="literal" />
            </output>
        </operation>
    </binding>

    <!-- Определение сервиса -->
    <service name="OrderService">
        <port name="OrderServicePort" binding="tns:OrderServiceBinding">
            <soap:address location="http://<?=$_SERVER['HTTP_HOST']?>/Kris_service.php" />
        </port>
    </service>