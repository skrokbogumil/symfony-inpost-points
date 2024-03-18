<?php

namespace App\Tests\Application\Service;

use App\Application\Service\InpostPoints;
use App\Domain\Ports\Client\InpostHttpClientInterface;
use App\Domain\Ports\Deserializer\DeserializerInterface;
use App\Domain\Model\Point;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InpostPointsTest extends WebTestCase
{

    public function testFetchSuccess()
    {
        $inpostPoints = $this->getInpostPoints($this->getMockClientResponse());
        $points = $inpostPoints->fetch(InpostPoints::POINTS_METHOD, ['city' => 'Kozy']);

        $this->assertIsObject($points);

        $this->assertSame(12, $points->getCount());
        $this->assertSame(5, $points->getPerPage());
        $this->assertSame(1, $points->getPage());
        $this->assertSame(1, $points->getTotalPages());

        $items = $points->getItems();
        $this->assertIsArray($items);;
        $this->assertCount(1, $items);

        /** @var Point $point */
        $point = $items[0];
        $this->assertIsObject($point);

        $this->assertSame('KZY01A', $point->getName());

        $address = $point->getAddress();
        $this->assertSame("Gajowa 27", $address->getLine1());
        $this->assertSame("43-340 Kozy", $address->getLine2());
        $this->assertSame("Gajowa", $address->getStreet());
        $this->assertSame("27", $address->getBuildingNumber());
        $this->assertSame(null, $address->getFlatNumber());
    }

    private function getMockClientResponse(): string
    {
        return '{"href":"https://api-pl-points.easypack24.net/v1/points","count":12,"page":1,"per_page":5,"total_pages":1,"items":[{"href":"https://api-pl-points.easypack24.net/v1/points/KZY01A","name":"KZY01A","type":["parcel_locker"],"status":"Operating","location":{"longitude":19.17134,"latitude":49.84569},"location_type":"Outdoor","location_date":null,"location_description":"obok sklepu","location_description_1":null,"location_description_2":null,"distance":null,"opening_hours":"24/7","address":{"line1":"Gajowa 27","line2":"43-340 Kozy"},"address_details":{"city":"Kozy","province":"śląskie","post_code":"43-340","street":"Gajowa","building_number":"27","flat_number":null},"phone_number":null,"payment_point_descr":"Płatność apką InPost oraz PayByLink","functions":["allegro_courier_collect","allegro_courier_reverse_return_send","allegro_courier_send","allegro_letter_reverse_return_send","allegro_letter_send","allegro_parcel_collect","allegro_parcel_reverse_return_send","allegro_parcel_send","parcel","parcel_collect","parcel_reverse_return_send","parcel_send","standard_courier_reverse_return_send","standard_courier_send"],"partner_id":0,"is_next":false,"payment_available":true,"payment_type":{"0":"Payments are not supported"},"virtual":"0","recommended_low_interest_box_machines_list":null,"apm_doubled":null,"location_247":true,"operating_hours_extended":{"customer":null},"agency":"BBA","image_url":"https://static.easypack24.net/points/pl/images/KZY01A.jpg","easy_access_zone":true,"air_index_level":null,"physical_type_mapped":"003","physical_type_description":null}]}';
    }

    public function testEmptyFetch()
    {
        $inpostPoints = $this->getInpostPoints('{"href":"https://api-pl-points.easypack24.net/v1/points","count":0,"page":1,"per_page":0,"total_pages":1,"items":[]}');
        $points = $inpostPoints->fetch(InpostPoints::POINTS_METHOD, ['city' => 'Test']);

        $this->assertIsObject($points);

        $this->assertSame(0, $points->getCount());
        $this->assertSame(0, $points->getPerPage());
        $this->assertSame(1, $points->getPage());
        $this->assertSame(1, $points->getTotalPages());

        $items = $points->getItems();
        $this->assertIsArray($items);;
        $this->assertCount(0, $items);
    }

    private function getInpostPoints(string $clientResponse): InpostPoints
    {
        $deserializer = self::getContainer()->get(DeserializerInterface::class);
        $clientMock = $this->createMock(InpostHttpClientInterface::class);
        $clientMock->method('fetch')->willReturn($clientResponse);

        return new InpostPoints($clientMock, $deserializer);
    }
}