Feature: Availablity feature.

    Scenario: I can access the index route.
        When I send a GET request to "/"
        Then the response status code should be 200
        And the response content should be "Hello World!!"
