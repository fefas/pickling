Feature: Render homepage with a list of all features
  In order to have a home with a with all features
  As an developer
  I want to call render homepage method

  @wip
  Scenario: There is only one feature file on the root
    Given the feature file "/some-feature.feature" with the following content:
      """
      Feature: Some Feature
      """
    When I render homepage
    Then I will get the following result:
      """
      <!DOCTYPE>
      <html>
        <body>
          <h1>Features:</h1>
          <ul>
            <li>ome feature</li>
          </ul>
        </body>
      </html>
      """
