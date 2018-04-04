		<div class="services_other_header">
			<div class="phone_number"><p>8 495 798 90 08</p></div>
			<?php if(isset($CONTENT['TITLE'])AND($CONTENT['TITLE'])): ?>
			<div class="services_other_title">
				<p><?php echo $CONTENT['TITLE']; ?></p>
				<div class="services_other_line"></div>
			</div>
			<?php endif; ?>
			<div class="bus_img">
				<img src="../../../assets/img/services/bus_min.png" alt="">
			</div>
			<div class="services_lines">
				<svg width="100%" height="88px">
					<image  x="0px" y="0px" width="100%" height="88px"  xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAyMAAABYCAMAAADRANhoAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAANlBMVEX///8NWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJkNWJn///+jIN0EAAAAEHRSTlMAMMBQsBCAQKCQ0CDgYHDwYRGFKAAAAAFiS0dEAIgFHUgAAAAHdElNRQfiAxoTBAJ7XmQDAAAEb0lEQVR42u3d7ZabIBCA4YCCnyj3f7XVtKfbhmlWGxMGfZ9/2ePJahSBYRxvN6hgrLVfnypra5d7lwBVfIzx61OzfGpy7xKgSksbAZ7q+th+fRr6aE3uXQIAAABwLaZth9z7AGg2xmhf/xbgvOJfIWAAj2gjwHM2xi73PgCqNSyvA3dV7avtW7vga+JduJYxxn771maZpvjcuwx81HLR1/s2JyaMSzFLPxJ2bF/TRnA9+/J6yQIGAAAAAAAAAG2M7Q4O3rqqbanAhfOoY4zH5ltNyzdOuQ8LOIqLu7Kzthh2JrMAqg318Td9G8f29W8B1Ng4HdlR84HsFFwSNR+A53ieHXiONgI8R80HXMEU7Z7Hp/72Qs0H58eZh95RgvHwBcNtwvJ/CQcXb/D+9LVxsl2qbl7+8+nzU4KfTnOMwdokoWhdHI5JyZzK+/8fmygU+jHPjWCK7ZnuQG7yPlkE6qSUBVPbusDlovVtZcna8vrSv6QGzn3LUzUSHGJ9/d38+McoRf56aUv9Jqk5GKk5iA3n1llLyt5luNbaZHwxS81hzQ4dN22pi6nH/rGrWwfHc9L/NcKwapiFAVgopHMxe6ot5uCmEobva5eRxDnEYdU6AEsCIpOU4BnGXs/TA/e5YrKLrmk27uEwpRN5uXNpfKXmqH/u0FobTnO8tRqXW5Wu38yE9CK36+lO7qjBh62XkBAyj5oyo+8jqIOzjNbOJQn2V1H4Y1Ze3R49uPfHqiby4kn0xz88cHvDVfmCZco0Hz3kWLqh5Npr1Z3woL4Or9XWiK14Es3x9fJbXefmQy8ECFKPbOY4fyh9w6QXW/DKIwuDED+VDuQd3FqB9XG05KWpx3sOvSkwHvyy0NVJfyUPZd/AlxFF2KCXwilvMEnx/5uv/cmvXWetqtHOPRiYdi79aI8e/cUyg/Cp5h0jdW9jLXYZqvpZF/oPjDm8tsNeK7AnqR9WDJhXYWPzdl5Yt41vmFdmMYgRn8rWG8+ra6Y0BCU1h2EUxlpZ2Y+MOeZMCXv7fwsx3p7cPo0VVq+stFAV5rnEhAdBsHFMel7xnt9JCUXSepa4ZKzPZ3LpprGE3FLxtxDTGMbNCQ/n1kidSyVd+WJzcMvvOOq/dy63+I9MFcq4l5p0N2upOYhpDF225acdNR+O5f6Z7SAmFKXDsqaAFrIoYy+zWWYZrTiQTqdxVZUpMJGv5oM0y3BiBKyyraoZKd5tUHUD1DbIM7qCmIC6NgJoQ82H4jTK8mzP70NpPfht2JpcLDPaFgyBg43CUtge4TQpSoCsfrFQRlfEojrw/6ZXn7doJuWPogKvcVMoY1UcAAAAAAAAAAAgl4aUOlyba56X5ep4egEX10ivyPmDpY3g4ppvCrzYk1RZK1e2mg/4xXzTRoI/e5lJ7fLVfMAv1QXe2Vk0nmcHnqONAM9R8wH4BgtUAAAAAAAAAAB8BEl0gOzeNkJfwKsegTz62ZrbG17VDZzF/cWY/Yul5YHz+vkwSTdbyl4DMt/H5ge9HixrQK78fAAAAABJRU5ErkJggg==" />
				</svg>
			</div>
			<div class="services_other_items">
				<div class="services_other_item">
					<?php if(isset($CONTENT['LEFT_IMAGE'])AND($CONTENT['LEFT_IMAGE'])): ?>
					<div class="services_other_item_img">
						<img src=<?php echo '"'.$CONTENT['LEFT_IMAGE'].'"'; ?> alt="">
					</div>
					<?php endif; ?>
					<?php if(isset($CONTENT['LEFT_IMAGE_SIGN'])AND($CONTENT['LEFT_IMAGE_SIGN'])): ?>
					<div class="services_other_item_text">
						<p><?php echo $CONTENT['LEFT_IMAGE_SIGN']; ?></p>
					</div>
					<?php endif; ?>
				</div>
				<div class="services_other_item">
					<?php if(isset($CONTENT['MIDDLE_IMAGE'])AND($CONTENT['MIDDLE_IMAGE'])): ?>
					<div class="services_other_item_img">
						<img src=<?php echo '"'.$CONTENT['MIDDLE_IMAGE'].'"'; ?> alt="">
					</div>
					<?php endif; ?>
					<?php if(isset($CONTENT['MIDDLE_IMAGE_SIGN'])AND($CONTENT['MIDDLE_IMAGE_SIGN'])): ?>
					<div class="services_other_item_text">
						<p><?php echo $CONTENT['MIDDLE_IMAGE_SIGN']; ?></p>
					</div>
					<?php endif; ?>
				</div>
				<div class="services_other_item">
					<?php if(isset($CONTENT['RIGHT_IMAGE'])AND($CONTENT['RIGHT_IMAGE'])): ?>
					<div class="services_other_item_img">
						<img src=<?php echo '"'.$CONTENT['RIGHT_IMAGE'].'"'; ?> alt="">
					</div>
					<?php endif; ?>
					<?php if(isset($CONTENT['RIGHT_IMAGE_SIGN'])AND($CONTENT['RIGHT_IMAGE_SIGN'])): ?>
					<div class="services_other_item_text">
						<p><?php echo $CONTENT['RIGHT_IMAGE_SIGN']; ?></p>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>