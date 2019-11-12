export interface Recipe {
  id?: string;
  title: string;
  description: string;
  createdAt?: Date;
}

export interface Response {
  status: string;
  results?: number;
  data?: any;
}
