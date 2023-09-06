# Changelog

All notable changes to `gerbang-bayar/atome` will be documented in this file

## 0.0.0 - 2023-08-30

- Initial release

Added
- Integrate with Atome payment API.
- Added `CreatePayment`, `CheckConfiguration`, `GetPayment`, `CancelPayment`, `RefundPayment` requests.

## 0.0.1 - 2023-09-07

Changed
- Fix `refund` method. Additional params added (amount and refundId) and request body added.
