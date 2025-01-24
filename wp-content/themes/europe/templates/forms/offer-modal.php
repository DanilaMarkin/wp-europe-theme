<aside id="offerModal" class="modal-offer">
    <div class="modal-offer-content">
        <button class="modal-offer-close" aria-label="Close">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/close.svg" alt="Close icon" title="Close the offer" class="modal-offer-close-img">
        </button>
        <h2 class="modal-offer-title">Offer Your Price</h2>
        <form id="offerForm">
            <label for="price">Price</label>
            <input type="text" id="priceOffer" name="price" placeholder="Enter your price">

            <label for="quantity">Quantity</label>
            <input type="number" id="quantityOffer" name="quantity" placeholder="Enter quantity">

            <label for="name">Name</label>
            <input type="text" id="nameOffer" name="name" placeholder="Enter your name">

            <label for="phone">Phone (WhatsApp)</label>
            <input type="tel" id="phoneOffer" name="phone" placeholder="Enter your phone">

            <label for="address">Address</label>
            <textarea id="addressOffer" name="address" placeholder="Enter your address" rows="3"></textarea>

            <button type="submit" class="modal-offer-submit">Send</button>
        </form>
        <div id="loaderOfferPrice" class="loader-blocks-contact hidden">
            <span class="loader"></span>
        </div>
    </div>
</aside>