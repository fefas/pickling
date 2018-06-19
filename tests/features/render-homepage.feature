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
            <li><a href="?feature=/some-feature">Some feature</a></li>
          </ul>
        </body>
      </html>
      """

  Scenario: There are two feature files on the root
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
            <li><a href="?feature=/some-feature-1">Some feature 1</a></li>
            <li><a href="?feature=/some-feature-2">Some feature 2</a></li>
          </ul>
        </body>
      </html>
      """

  Scenario: There are feature files on the root and on sub-folders
    Given the feature file "/some-feature-1.feature" with the following content:
      """
      Feature: Some Feature 1
      """
    And the feature file "/group/some-feature-2.feature" with the following content:
      """
      Feature: Some Feature 2
      """
    And the feature file "/group/some-feature-3.feature" with the following content:
      """
      Feature: Some Feature 3
      """
    When I want see the homepage
    Then I get the following content:
      """
      <html>
        <body>
          <h1>Features:</h1>
          <ul>
            <ul>
              <li><a href="?feature=/group/some-feature-2">Group some feature 2</a></li>
              <li><a href="?feature=/group/some-feature-3">Group some feature 3</a></li>
            </ul>
            <li><a href="?feature=/some-feature-1">Some feature 1</a></li>
          </ul>
        </body>
      </html>
      """
