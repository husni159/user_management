<?php
namespace Tests\Unit;

use App\Services\InjectionService;
use App\Services\LeadInjectionService;
use App\Services\CustomerInjectionService;
use App\Models\Lead;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Customer;


class InjectionServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testItInjectsLeadToContactsTable()
    {
        // Create a lead record in the leads table
        $lead = Lead::create([
            'first_name' => 'Husni',
            'last_name' => 'sameena',
            'postal_code' => '12345',
        ]);
        // Use the InjectionService to inject lead data into the contacts table
        $injectionService = new InjectionService();
        $leadInjectionService = new LeadInjectionService();

        $injectionService->inject($leadInjectionService, ['lead_id' => $lead->id]);

        // Assert the contact with the lead data
        $contact = Contact::where('first_name', 'Husni')->first();

        $this->assertNotNull($contact);
        $this->assertEquals('Husni', $contact->first_name);
        $this->assertEquals('sameena', $contact->last_name);
        $this->assertEquals('12345', $contact->postal_code);

    }
    
    public function testItInjectsCustomerToContactsTable()
    {
        // Create a customer record in the customer table
        $lead = Customer::create([
            'first_name' => 'Husni customer',
            'last_name' => 'sameena customer',
            'postal_code' => '12345123',
            'city' => 'kochi customer',
        ]);
        // Use the InjectionService to inject customer data into the contacts table
        $injectionService = new InjectionService();
        $customerInjectionService = new CustomerInjectionService();

        $injectionService->inject($customerInjectionService, ['customer_id' => $lead->id]);

        // Assert the contact with the customer data
        $contact = Contact::where('first_name', 'Husni customer')->first();

        $this->assertNotNull($contact);
        $this->assertEquals('Husni customer', $contact->first_name);
        $this->assertEquals('sameena customer', $contact->last_name);
        $this->assertEquals('12345123', $contact->postal_code);
        $this->assertEquals('kochi customer', $contact->city);

    }
}
