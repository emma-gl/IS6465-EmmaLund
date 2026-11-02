# Lab 4 Notes: Peer Tutoring Hub

## Part 1: Run the application

When I clicked **Request session**, the browser sent the form data to `process-request.php` using a POST request. The script validated every field, found no errors, and showed a "Request received" confirmation page. That page listed the course, the request details, the selected topics, and a status of "Pending review."

![Confirmation page after submitting a valid request](images/Screenshot%202026-11-01%20174140.png)

## Part 2: Trace the templates

**What content does header.php provide to every page?**
`header.php` provides the start of every HTML page. It includes the `<!doctype html>` declaration, the opening `<html>` and `<head>` tags, the character set and viewport meta tags, the Bootstrap CSS link, the link to the application's own stylesheet, the page title "Peer Tutoring Hub," and the opening `<body>` tag.

**What content does nav.php provide?**
`nav.php` provides the blue Bootstrap navigation bar at the top of each page. It shows the "Peer Tutoring Hub" brand link and two navigation links: **Requests** (to `requests.php`) and **Request a Session** (to `request-form.php`).

**What content does footer.php provide?**
`footer.php` provides the footer that displays "Peer Tutoring Hub" at the bottom of the page. It also loads the Bootstrap JavaScript bundle and closes the `<body>` and `<html>` tags that `header.php` opened.

**Why is require_once appropriate for these files?**
`require_once` is appropriate because every page needs these templates to build a complete HTML document. If a template file is missing, `require` stops the script with an error instead of showing a broken page, which is what happens with `include`. The "once" part makes sure each template is added only one time, so the page never ends up with a duplicate `<head>` tag, a second navigation bar, or a second set of closing tags.

**Where is the shared CSS file linked?**
The shared CSS file is linked in `includes/header.php` with `<link rel="stylesheet" href="css/styles.css">`. This link comes right after the Bootstrap stylesheet, so the custom styles can override Bootstrap's defaults. Because every page requires `header.php`, every page gets the same styling.

## Part 3: Observe the form controls

**reason**:
The `reason` control is a `<textarea>` where the student describes what they need help with. It is required and limited to 500 characters in the browser. PHP receives it as a single **string** in `$_POST["reason"]`, and `process-request.php` trims it and checks that it has 10 to 500 characters.

**topics[]**:
The `topics[]` controls are a group of checkboxes for Exam review, Practice problems, and Study plan. The square brackets in the name tell PHP to collect every checked box into a list. As a result, PHP receives an **array** of strings in `$_POST["topics"]`, such as `["Exam review", "Practice problems"]`. If no boxes are checked, the browser sends nothing for this field, so the script uses `?? []` to default to an empty array.

**preferredtime**:
The `preferredtime` control is a group of radio buttons for Morning, Afternoon, and Evening, and they all share the same name. Because they share a name, the student can select only one option. PHP receives a single **string** in `$_POST["preferredtime"]`, which is then checked against the list of allowed times.

**preferreddate**:
The `preferreddate` control is an `<input type="date">` that shows a date picker. It lets the student choose the day they want the session. PHP receives a single **string** in `YYYY-MM-DD` format (for example, `"2026-11-05"`), not a date object. The script converts that string to a `DateTimeImmutable` object so it can check that the date is real and not in the past.

**form_name**:
The `form_name` control is a hidden input with the value `tutoring_request`. The student never sees it, but it is submitted with the form so the processing script can confirm the data came from the tutoring request form. PHP receives it as a single **string** in `$_POST["form_name"]`, and the request is rejected if the value is not exactly `tutoring_request`.

## Part 4: Test validation behavior

### Test 1: Valid request

- **Values entered:** Course: IS 6465; Preferred date: 2026-11-05; Reason: "I need help reviewing PHP arrays for the midterm."; Topics: Exam review, Practice problems; Preferred time: Afternoon.
- **Result:** The request was **accepted**.
- **Message displayed:** "Request received," followed by "Course: IS 6465," "Request details: I need help reviewing PHP arrays for the midterm.," "Topics: Exam review, Practice problems," and "Status: Pending review."
- **Business rule checked:** A request is accepted only when every rule passes: the course must be one of the offered courses, the preferred time must be Morning, Afternoon, or Evening, the reason must be 10 to 500 characters, at least one valid topic must be selected, the date must be a real date that is today or later, and the form name must be `tutoring_request`.

### Test 2: Missing or invalid value

- **Values entered:** Course: IS 6465; Preferred date: 2026-11-05; Reason: "I need help reviewing PHP arrays for the midterm."; Topics: none checked; Preferred time: Afternoon.
- **Result:** The request was **rejected** with an HTTP 400 status.
- **Message displayed:** "Request could not be submitted" with the error "Select at least one valid topic."
- **Business rule checked:** A student must select at least one topic, and every topic must come from the allowed list (Exam review, Practice problems, Study plan). The browser cannot enforce this rule for a checkbox group, so the server-side check in PHP is what catches it.

### Test 3: Past date

- **Values entered:** Course: IS 6465; Preferred date: 2026-10-15 (before today, 2026-11-01); Reason: "I need help reviewing PHP arrays for the midterm."; Topics: Study plan; Preferred time: Morning.
- **Result:** The request was **rejected** with an HTTP 400 status.
- **Message displayed:** "Request could not be submitted" with the error "Preferred date cannot be in the past."
- **Business rule checked:** A tutoring session can only be requested for today or a future date. The script compares the submitted date to `new DateTimeImmutable("today")` and rejects any earlier date.

## Part 5: Review testing and CRUD pages

### Validation test results

When I opened `tests/validation-tests.php`, all 10 test cases showed **PASS**:

| Test case | Result |
|---|---|
| Valid time | PASS |
| Missing time | PASS |
| Altered value | PASS |
| Multiple valid topics | PASS |
| Missing topics | PASS |
| Altered topic | PASS |
| Minimum length | PASS |
| Maximum length | PASS |
| Too short | PASS |
| Too long | PASS |

These tests show that the validation functions accept good values and reject missing, altered, too-short, and too-long values. They also check the exact boundaries of 10 and 500 characters for the reason field.

### CRUD pages

| CRUD action | Page |
|---|---|
| Create | `request-form.php` (submits to `process-request.php`) |
| Read one request | `request-details.php` |
| Read all requests | `requests.php` |
| Update | `edit-request.php` |
| Delete | `delete-request.php` |

### Questions

**What query parameter appears in the request details URL?**
The request details URL uses the `request_id` query parameter, for example `request-details.php?request_id=12`. The details page reads this value with `filter_input(INPUT_GET, 'request_id', FILTER_VALIDATE_INT)` and uses it to find the matching request.

**Why is a GET query parameter appropriate for viewing one request?**
A GET query parameter is appropriate because viewing a request only reads data and does not change anything on the server. 

**Why should an actual update or delete later use POST rather than GET?**
An update or delete changes data, so it should use POST. GET requests are never meant change any data. POST makes the change happen only when the user deliberately submits a form and lets the server protect the action with checks such as CSRF tokens. This is why `edit-request.php` and `delete-request.php` already use `method="post"` forms.
