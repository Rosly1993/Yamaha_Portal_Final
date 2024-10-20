<style>
  .modal-body {
    overflow: hidden; /* Prevent overflow in the modal body */
}

.iframe-container {
    height: 85vh; /* Fixed height for the container */
    overflow-y: auto; /* Allow vertical scrolling */
    position: relative; /* For overlay positioning */
}

.pdf-page {
    display: block; /* Ensure each canvas is displayed as a block */
    margin: 0 auto; /* Center align the pages if necessary */
    width: 100%; /* Ensure the canvas takes full width of the container */
}

#overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10; /* Ensure it's above the PDF */
    pointer-events: none; /* Allow interactions with elements below */
}

</style>
<div class="modal fade" id="attachmentModal" tabindex="-1" aria-labelledby="attachmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 95%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 style="color: white; text-align: center" class="modal-title" id="attachmentModalLabel">Attachment's Viewing</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="iframe-container" id="pdfContainer">
                    <!-- PDF pages will be appended here -->
                </div>
                <div id="overlay"></div> <!-- Adjusted overlay to not interfere -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
