
declare var M;
export class MaterialService {
  static updateTextField() {
    M.updateTextFields();
  }

  static toast(message: string) {
    M.toast({html: message});
  }
}
