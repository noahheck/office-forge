# Access Controls

Office Forge utilizes a number of features from Laravel for security purposes. We use their default Authentication services for user authentication, and we use their Authorization system to help control access for these users to resources within the software. The Laravel Authorization system allows us to express access authorizations as Policies and provides a number of convenient helper functions/methods to verify access using these Policies.

Most resources within Office Forge contain 2 levels of access control:

- Team Membership
- Access Locks and Keys

Effective utilizing both of these features allows system administrators to set up and maintain an appropriate authorization scheme for their organization.

### Team Membership

Top level access controls are defined through a Staff Member's Team Memberships. In general, resource types are specified as being accessible only to members of specified Teams. Unless a Staff Member is a member of one of the specified Teams, they will be unable to access any resources of that type.

For example, consider a FileType resource named "Employee". These Files represent the cumulative employment record for employees at the company. There are various legal and practical reasons to ensure only Staff Members with a legitimate business need are able to access to these Files.

Team Access Restrictions are used to ensure a Staff Member must be a member of a designated Team in order to view any resources of a particular type. The "Employee" Files discussed above can be restricted for access only to members of the "HR" and "Management" Teams. Unless a Staff Member is a member of one of these Teams, they will be unable to access any "Employee" files.

@warning
Resource Types that don't have any Team Access Restrictions will be accessible by all staff members.
@endwarning

### Access Locks and Access Keys

Team Access Restrictions are a great tool for granting a wide blanket of access to Resource types, but trying to use Teams to implement all necessary levels of access control can quickly become unruly.

To illustrate this, let's consider the Employee files mentioned above. While members of the HR Team should have access to all Employee files, members of the Management Team would only need to have access to the Employee files for the employees that report directly to them. To implement the appropriate access controls using only Team Access Restrictions would likely result in a number of duplicate Resource Types (e.g., a "*\*-Employee*" FileType for each department) along with a number of single-member Teams (e.g., "*\* Department Manager*" Team, with the sole member of each Team being the Department Manager).

To provide a suitable level of access control without being too cumbersome, Office Forge defines a second layer of controls called Access Locks with corresponding Access Keys. In the Admin interface, Administrators can define a set of Access Locks for each Resource Type. For each type of Access Lock, Staff Members are assigned the appropriate set of Access Keys that will grant them access to specific instances of a resource type.

Upon creation or updating, resources can be assigned zero, one, or more Access Locks. When a Staff Member attempts to access a resource with any assigned Access Locks, Office Forge verifies the Staff Member has at least one corresponding Access Key before granting access to the Resource.

An Employee File for an employee in the Marketing Department can be assigned the "Marketing Department" Access Lock, and the Marketing Department supervisor can be provided the "Marketing Department" Access Key. This ensures the Employee File isn't accessible by managers of other departments, while still being accessible to members of the HR department.

@note
If a resource doesn't have any assigned Access Locks, the appropriate Team Access Restrictions are still evaluated to ensure the Staff Member can access it.
@endnote
