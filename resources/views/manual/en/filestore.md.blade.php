# FileStore

FileStore is Office Forge's document and media file hosting and sharing service. This system allows organizations to upload, manage access to, and share files among their staff members. These files are securely stored on your Office Forge server and accessible from any web browser so you'll always have access to your most important information.

### Drives

The FileStore service is organized into Drives. Drives are created and configured by an organization Administrator from the Administrative settings area.

#### Access Controls

When configuring a Drive, Administrators can choose to restrict access to a Drive based on a Staff Member's Team membership. If a Drive has been restricted, a Staff Member must be a member of at least one of the Teams that has been granted access to the Drive or they will have no access to it or the documents and files within that Drive.

See more information about [Access Controls]({{ route('manual', ['access-controls']) }}).

@note
Administrators are able to access all Drives regardless of their Team memberships.
@endnote

Access the FileStore option from the main Office Forge navigation menu and you'll be presented with a list of all the Drives you have access to:

@manualImage('fileStore_drives.png', 'List of FileStore Drives within Office Forge')


### Documents and Files

Within a Drive, you'll see a listing of all the documents and files that have been stored there.

@manualImage('fileStore_hoverOptions.png', 'Listing of files and folders within a Drive. The cursor is hovering over an entry which shows additional options to preview the file in the browser or download the file to the user\'s device.')

Select a file to view and edit details about the file.

Hovering the mouse cursor over an entry in the listing reveals one or more quick options for each file. Click the <button class="btn btn-primary btn-sm">{!! \App\icon\mediaFileDownload([]) !!}</button> button to download the file directly to your device.


For supported files (images, pdfs, etc), you can click the <button class="btn btn-primary btn-sm">{!! \App\icon\mediaFilePreview([]) !!}</button> button to preview the file in your browser.


### Uploading Files

Click the <button class="btn btn-primary btn-sm">{!! \App\icon\mediaFileUpload(['mr-2']) !!}Upload File</button> button and you'll be presented with a form to upload new files to FileStore.

@manualImage('fileStore_uploadImage.png', 'Form showing input fields for a file to upload, a name to give to the file, and a description field to gather additional details about the file.')

Select a file to upload (supported files will display a preview of the selected file), change the filename if desired, and optionally provide some additional information about the file. Click the <button class="btn btn-primary btn-sm">Save</button> button to upload the file to FileStore.

@tip

Most modern browsers allow drag-and-drop of files onto the File form, which can save considerable time compared to navigating through the File selection dialog window.

@endtip

Once a file has been uploaded, it can immediately be viewed and downloaded by any Staff Member who has access to the Drive.

### Organizing Files with Folders

Within a Drive, uploaded files can be further organized through the use of Folders. Click the <button class="btn btn-primary btn-sm">{!! \App\icon\folderPlus(['mr-2']) !!}Add Folder</button> button to create a new Folder in the current view. Once created, files can then be uploaded into a Folder to help keep your FileStore organized. You can also create any number of child folders within a Drive.

@tip
A thoughtful FileStore organization scheme can really help your Staff Members, ensuring they can access and use their tools and resources efficiently.
@endtip

### Uploading Multiple Files at Once

For desktop browsers that support the drag-and-drop api (most modern browsers), you can upload one or more files at once by dragging them from your desktop directly into the Drive or Folder of your choice:

@manualImage('fileStore_dragAndDrop.png', 'FileStore Drive showing a file being dragged over it causing it to be highlighted and have instructions on how to upload the file to the Drive appear.')

@technote
PHP provides technical safeguards to limit the maximum number of files uploaded per request as well as the maximum combined size of uploaded files. These safeguards are configurable through their respective `php.ini` directives. See the <a href="https://www.php.net/manual/en/ini.core.php#ini.sect.file-uploads" target="_blank">PHP Manual entry on File Uploads ini directives</a> for more information.
@endtechnote

### Deleting Files

Uploaded files can be deleted from the Edit File screen. You'll be prompted to confirm that you want the file to be deleted. Click <button class="btn btn-warning btn-sm">Confirm</button> to continue with deleting the file, or <button class="btn btn-secondary btn-sm">Cancel</button> to stop the operation.

@manualImage('fileStore_confirmDelete.png', 'A dialog box confirming the Staff member wants to proceed with deleting an uploaded file.')

@warning
Once a file has been deleted, it's gone for good.
@endwarning

