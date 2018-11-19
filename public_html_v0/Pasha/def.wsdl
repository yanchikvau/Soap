<?php
/**
 * smsservice.wsdl.php
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
				   
			
			<xs:omplexType name="Order">
				<xs:sequence>
					<xs:element name="order_id" type="xs:decimal" minOccurs="1" maxOccurs="1" />
				</xs:sequence>
			</xs:complexType>	   
				   
            <xs:complexType name="Order_info">
				<xs:sequence>
					<xs:element name="order_id" type="xs:decimal" minOccurs="1" maxOccurs="1" />
					<xs:element name="dish_name" type="xs:string" />
					<xs:element name="number_of_servings" type="xs:decimal"minOccurs="1" maxOccurs="1"  />
					<xs:element name="weigth" type="xs:decimal" minOccurs="1" maxOccurs="1" />
					<xs:element name="date" type="xs:date"minOccurs="1" maxOccurs="1"  />
					<xs:element name="price" type="xs:decimal"minOccurs="1" maxOccurs="1"  />
				</xs:sequence>
			</xs:complexType>
			
			
            <xs:element name="Request">
                <xs:complexType>
                    <xs:sequence>
                        <xs:element name="order" type="Order"  />
                    </xs:sequence>
                </xs:complexType>
            </xs:element>
            <xs:element name="Response">
                <xs:complexType>
                    <xs:sequence>
                        <xs:elementname="order_info" type="Order_info" />
                    </xs:sequence>
                </xs:complexType>
            </xs:element>
        </xs:schema>
    </types>

    <!-- Сообщения процедуры sendSms -->
    <message name="sendDeliveryRequest">
        <part name="Request" element="tns:Request" />
    </message>
    <message name="sendDeliveryResponse">
        <part name="Response" element="tns:Response" />
    </message>

    <!-- Привязка процедуры к сообщениям -->
    <portType name="DeliveryServicePortType">
        <operation name="sendDelivery">
            <input message="tns:sendDeliveryRequest" />
            <output message="tns:sendDeliveryResponse" />
        </operation>
    </portType>

    <!-- Формат процедур веб-сервиса -->
    <binding name="DeliveryServiceBinding" type="tns:DeliveryServicePortType">
        <soap:binding transport="http://schemas.xmlsoap.org/soap/http" />
        <operation name="sendDelivery">
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
    <service name="DeliveryService">
        <port name="DeliveryServicePort" binding="tns:DeliveryServiceBinding">
            <soap:address location="http://<?=$_SERVER['HTTP_HOST']?>/deliveryservice.php" />
        </port>
    </service>
</definitions>