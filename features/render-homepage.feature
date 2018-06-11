Feature: Render homepage with a list of all features
  In order to have a home with a with all features
  As an developer
  I want to call render homepage method

  Scenario: There is only one feature file on the root
    Given the feature file "/some-feature.feature" with the following content:
      """
      Feature: Some Feature
      """
    When I want see the homepage
    Then I get the following content:
      """
      <html>
        <body>
          <h1>Features:</h1>
          <ul>
            <li>Some feature</li>
          </ul>
        </body>
      </html>
      """

  Scenario: There is two features file on the root
    Given the feature file "/some-feature-1.feature" with the following content:
      """
      Feature: Some Feature 1
      """
    And the feature file "/some-feature-2.feature" with the following content:
      """
      Feature: Some Feature 2
      """
    When I want see the homepage
    Then I get the following content:
      """
      <html>
        <body>
          <h1>Features:</h1>
          <ul>
            <li>Some feature 1</li>
            <li>Some feature 2</li>
          </ul>
        </body>
      </html>
      """
